<?php
// include database connection
include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');

// include auth functions
include($_SERVER['DOCUMENT_ROOT'] . '/backend/auth/auth_functions.php');

$username = $_POST['username'];

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($con, $sql);
if ($result->num_rows > 0) {
    while ($thisuser = $result->fetch_assoc()) {
        $userID = $thisuser['id'];
        $hash = getRandom(20);

        // put user info for email in $user array
        $user['id'] = $thisuser['id'];
        $user['email'] = $thisuser['email'];
        $user['firstname'] = $thisuser['firstname'];
        $user['lastname'] = $thisuser['lastname'];
        $user['hash'] = $hash;

        // insert a row in the forgot pass table with a hash for link identifying
        $mysql = "INSERT INTO forgot_pass (userID, hash) VALUES ('$userID', '$hash')";
        if ($con->query($mysql) === TRUE) {
            // forgot pass row inserted, continue on
        } else {
            $response = [
                'code' => '0',
                'message' => "Error : " . $con->error
            ];
            echo json_encode($response);
            die();
        }
    }
} else {
    // user does not exist
    $response = [
        'code' => '0',
        'message' => 'Username does not exist'
    ];
    echo json_encode($response);
    die();
}

/*****************************************
 * Email them a link to reset password
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
    $mail->SMTPDebug = 0;

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
$mail->Subject = $forgot_pass_email['subject']; // var set in config/mail.php

// process php code and pass hash var
ob_start();
$hash = $user['hash'];
$userID = $user['id'];
include ( $_SERVER['DOCUMENT_ROOT'] . '/views/email/forgot_password.php');
$this_mail_body = ob_get_clean();

//Read a php message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body. Process php file as php.
$mail->Body = $this_mail_body;

// make the body for plain text from var in /config/mail.php

$mail_body_partial = explode('%link%', $forgot_pass_email['body']);
$mail_body = $mail_body_partial[0] . $domain . '/reset_password/'.$user['id'].'/'. $user['hash'] . '/'.$mail_body_partial[1];

//Replace the plain text body with one created manually
$mail->AltBody = $mail_body;

//Attach an image file
$mail->addAttachment($_SERVER['DOCUMENT_ROOT'].'/resources/img/logo.png', 'logo_2u');

//send the message, check for errors
if (!$mail->send()) {
    $response = [
        'code' => '0',
        'message' => 'Mailer Error: ' . $mail->ErrorInfo
    ];
    echo json_encode($response);
} else {
    $response = [
        'code' => '1',
        'message' => 'We have emailed you a link to reset your password.'
    ];
    echo json_encode($response);
}