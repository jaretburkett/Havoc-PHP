<?php
/**************************************************************
 * This script takes all form fields posted to it and puts them
 * in the tmp_users table. It excludes password2. All others
 * will be put in the column that matches the input name.
 *
 * Then, it emails the new user an activation link to
 * the email the entered on the form.
 *************************************************************/

// include database connection
include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');

// include auth functions
include($_SERVER['DOCUMENT_ROOT'] . '/backend/auth/auth_functions.php');

// put all post vars in array
foreach ($_POST as $key => $value) {
    if ($key == 'email'){
        $user[$key] = strtolower($value); // make email always lowercase
    }
    elseif ($key != 'password2') { // done use password 2 as it is just a verifier
        $user[$key] = $value;
    }
}

//generate a salt specific to the user
$salt = getSalt();
// get a salty password to hash from and store in cookies
$saltypass= crypt($password,$salt);
// change the password to be stored to a password hash of the salty password
$user['password'] = password_hash($saltypass, PASSWORD_DEFAULT);

// Super secure


// generate unique hash for email link url
$user['hash'] = getTmpHash();

/*****************************************
 * Insert new user into tmp_users database
 ****************************************/

// create mysql script
$i = 1;
$len = count($user);
$sql = "INSERT INTO tmp_users (";
foreach ($user as $key => $value) {
    $sql .= $key;
    if ($i != $len) // add comma if not last
        $sql .= ", ";
    $i++;
}
$sql .= ") VALUES (";
$i = 1;
$len = count($user);
$sql = "INSERT INTO tmp_users (";
foreach ($user as $key => $value) {
    $sql .= "'$value'";
    if ($i != $len) // add comma if not last
        $sql .= ", ";
    $i++;
}
// mysql script now in $sql


if ($con->query($sql) === TRUE) {
    // success, go ahead and store cookies so they wont have to login later
    // TODO make a way where a var can change cookie length
    setcookie("username",$user['username'],time()+31556926 ,'/'); // set cookie for a year
    setcookie("saltypass",$saltypass,time()+31556926 ,'/'); // set cookie for a year
} else {
    $errors = "Error : " . $con->error . '<br>';
}

/*****************************************
 * Email them an activation link
 ****************************************/
include($_SERVER['DOCUMENT_ROOT'] . '/config/vars.php');
include($_SERVER['DOCUMENT_ROOT'] . '/config/mail.php');
include($_SERVER['DOCUMENT_ROOT'] . '/backend/php-mailer/PHPMailerAutoload.php');

// if smtp
if ($send_via == 'smtp') {
    //SMTP needs accurate times, and the PHP time zone MUST be set
    //This should be done in your php.ini, but this is how to do it if you don't have access to that
    date_default_timezone_set($smtp_var['timezone']);

    //Create a new PHPMailer instance
    $mail = new PHPMailer;

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 2;

    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';

    //Set the hostname of the mail server
    $mail->Host = $smtp_var['host'];

    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = $smtp_var['port'];

    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = $smtp_var['security'];

    //Whether to use SMTP authentication
    $mail->SMTPAuth = $smtp_var['authentication'];

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = $smtp_var['username'];

    //Password to use for SMTP authentication
    $mail->Password = $smtp_var['password'];

    // if sendmail
} elseif ($send_via == 'sendmail') {
    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    // Set PHPMailer to use the sendmail transport
    $mail->isSendmail();
}

//Set who the message is to be sent from
$mail->setFrom($mail_var['from_email'], $mail_var['from_name']);

//Set an alternative reply-to address
$mail->addReplyTo($mail_var['from_email'], $mail_var['from_name']);

//Set who the message is to be sent to
$mail->addAddress($user['email'], $user['firstname'] . ' ' . $user['lastname']);

//Set the subject line
$mail->Subject = $reg_email['subject']; // var set in config/mail.php

//TODO make a system to use html files in email
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

// make the body from var in /config/mail.php
$mail_body_partial = explode('%link%', $reg_email['body']);
$mail_body = $mail_body_partial[0] . $domain . '/confirm_email/' . $user['hash'] . '/';

//Replace the plain text body with one created manually
$mail->AltBody = $mail_body;

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}