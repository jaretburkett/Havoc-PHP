<?php
include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');

/********************************************************
 * Is Logged In?
 *
 * Returns true or false if the current user is logged in
 ********************************************************/

function isLoggedIn()
{
    // check to see if cookies are set
    if (isset($_COOKIE['username']) && isset($_COOKIE['saltypass'])) {
        // if cookies set, get cookies
        $username = $_COOKIE['username'];
        $saltypass = $_COOKIE['saltypass'];

        // pull global connection var
        global $con;

        // pull user data and check salty pass
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($con, $sql);
        if ($result->num_rows > 0) {
            while($user = $result->fetch_assoc()) {
                if (password_verify($saltypass, $user['password'])) {
                    // it matches
                    // refresh cookie
                    setcookie("username",$username,time()+31556926 ,'/'); // set cookie for a year
                    setcookie("saltypass",$saltypass,time()+31556926 ,'/'); // set cookie for a year
                    return true;
                } else {
                    // It doesnt match
                    return false;
                }
            }
        }
        else // user does not exist
            return false;
    }
    else //cookies not set return not logged in
        return false;
}

/********************************************************
 * Get Ramdom
 *
 * Generates a random 10 character alpha-numeric string
 ********************************************************/
function getRandom($length = 10)
{
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $rand = '';
    for ($count = 0; $count < $length; $count++) {
        $rand .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $rand;
}

/********************************************************
 * Get salt
 *
 * Generates a random 10 character alpha-numeric string
 ********************************************************/
function getSalt()
{
    return getRandom(10);
}

/********************************************************
 * Get salt
 *
 * Generates unique 20 character string for tmp_users
 ********************************************************/
function getTmpHash()
{
    global $con;
    $unique = false;
    while ($unique != true){
        $rand = getRandom(20);
        $sql = "SELECT * FROM tmp_users WHERE 'hash' = '$rand'";
        $result = $con->query($sql);
        if ($result->num_rows == 0) {
            $unique = true;
        }
    }
    return $rand;
}
