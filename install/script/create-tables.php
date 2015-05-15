<?php
include ($_SERVER['DOCUMENT_ROOT'].'/config/connect.php');
// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(160) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)";

if ($con->query($sql) === TRUE) {
    echo "Havoc PHP Tables Created Successfully";
} else {
    echo "Error creating Havoc Tables: " . $con->error;
}

$con->close();