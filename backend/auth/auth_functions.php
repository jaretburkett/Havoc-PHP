<?php
include(DIR_ROOT . '/config/connect.php');

/********************************************************
 * Is Logged In?
 *
 * Returns true or false if the current user is logged in
 ********************************************************/

function isLoggedIn()
{
    // check to see if cookies are set
    if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
        // if cookies set, get cookies
        $email = $_COOKIE['email'];
        $password = $_COOKIE['password'];

        // pull global connection var
        global $con;

        // check to make sure cookies are accurate
        $sql = "SELECT * FROM users WHERE email='$email' and password='$password'";
        $result = mysqli_query($con, $sql);

        // Mysql_num_row is counting table row
        $count = mysqli_num_rows($result);

        // If result matched $email and $password, table row must be 1 row
        if ($count == 1) {
            //cookie user name and password are correct
            return true;
        } // if cookie username and password do not match return not logged in
        else
            return false;
    } //cookies not set return not logged in
    else
        return false;
}

/********************************************************
 * Get Salt
 *
 * Generates a random 10 character salt for password hashing
 ********************************************************/
function getSalt($length = 10)
{
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $salt = '';
    for ($count = 0; $count < $length; $count++) {
        $salt .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $salt;
}