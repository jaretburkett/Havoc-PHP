<?php

$mysql_vars = [
    'host' => 'localhost',          // Host name
    'username' => 'yourusername',   // Mysql username
    'password' => 'yourpassword',   // Mysql password
    'db_name' => 'havoc'            // Database name
];

// include special file that is git ignored to store sensitive data
// if it exists, the git_ignored_vars.php file overrides these vars
if(file_exists($_SERVER['DOCUMENT_ROOT'].'/config/git_ignored_vars.php'))
    include ($_SERVER['DOCUMENT_ROOT'].'/config/git_ignored_vars.php');

//Connect to server and select database.
$con=mysqli_connect($mysql_vars['host'], $mysql_vars['username'], $mysql_vars['password']);

// if an error occured
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_select_db($con,$mysql_vars['db_name']);

?>