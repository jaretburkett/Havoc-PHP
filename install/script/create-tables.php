<?php
include ($_SERVER['DOCUMENT_ROOT'].'/config/connect.php');

// setup a holder to count success
$tables_created = 0;

// set a var to hold errors
$errors = '';
// Create user tables
$sql = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(21) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)";

if ($con->query($sql) === TRUE) {
    $tables_created++;
} else {
    $errors .= "Error creating Havoc user table: " . $con->error. '<br>';
}

// create temp user table. Users will be placed here until they confirm email.
$sql = "CREATE TABLE IF NOT EXISTS `tmp_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hash` varchar(21) DEFAULT NULL,
  `username` varchar(21) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)";


if ($con->query($sql) === TRUE) {
    $tables_created++;
} else {
    $errors .= "Error creating Havoc tmp_user table: " . $con->error. '<br>';
}


// Create forgot password table
$sql = "CREATE TABLE IF NOT EXISTS `forgot_pass` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) NOT NULL,
  `hash` varchar(21) NOT NULL,
  `req_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)";

if ($con->query($sql) === TRUE) {
    $tables_created++;
} else {
    $errors .= "Error creating Havoc user table: " . $con->error. '<br>';
}

if ($tables_created == 3) {
    echo "Havoc PHP Tables Created Successfully";
} else {
    echo $errors;
}

$con->close();