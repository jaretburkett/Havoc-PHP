<?php
$connect_host="localhost"; // Host name 
$connect_username="root"; // Mysql username
$connect_password=""; // Mysql password
$connect_db_name="havoc"; // Database name

//Connect to server and select database.
$con=mysqli_connect("$connect_host", "$connect_username", "$connect_password");

// if an error occured
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_select_db($con,"$connect_db_name");

?>