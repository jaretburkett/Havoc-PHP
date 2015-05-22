<?php
/**
 * This script is used on the registration page to check if
 * username is avaliable. Returns true or false.
 */
include($_SERVER['DOCUMENT_ROOT'] . '/backend/auth/check_username_availability.php');
$username = $_POST['username'];

if (!username_aval($username)) {
    echo "false"; //already registered
} else {
    echo "true";  //username is available
}
?>