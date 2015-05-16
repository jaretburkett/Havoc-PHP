<?php
/**
 * This script is used on the registration page to check if
 * email is avaliable. Returns true or false.
 */
include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');
$username = $_POST['username'];
$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($con, $sql);
if ($result->num_rows > 0) {
    echo "false"; //already registered
} else {
    echo "true";  //email is available
}
?>