<?php
/***************
 * Mail Settings
 **************/

$send_via = 'smtp'; // smtp, sendmail

/***************
 * Mail Settings
 **************/
$mail_var = [
    'from_email' => 'your@email.com',
    'from_name' => 'FirstName LastName',
];


/***************
 * SMTP Settings
 **************/

$smtp_var = [
    'host' => 'smtp.gmail.com',
    'port' => 587,
    'security' => 'tls',
    'authentication' => true,
    'username' => 'username@gmail.com',
    'password' => 'yourpassword',
    'timezone' => 'America/Chicago' // for a list of supported timezones visit http://php.net/manual/en/timezones.php
];

/******************
 * Emails Content
 *****************/

// registration email
$reg_email =[
  'subject' => "Confirm Your Email Address",
    'body' => "Thank you for registering with $website_name. "
        ."Go to this link to confirm verify your email. %link% "
];


// include special file that is git ignored to store sensitive data
// if it exists, the git_ignored_vars.php file overrides these vars
if(file_exists($_SERVER['DOCUMENT_ROOT'].'/config/git_ignored_vars.php'))
    include ($_SERVER['DOCUMENT_ROOT'].'/config/git_ignored_vars.php');