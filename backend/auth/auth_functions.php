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
            while ($user = $result->fetch_assoc()) {
                if (password_verify($saltypass, $user['password'])) {
                    // it matches
                    // refresh cookie
                    setcookie("username", $username, time() + 31556926, '/'); // set cookie for a year
                    setcookie("saltypass", $saltypass, time() + 31556926, '/'); // set cookie for a year
                    return true;
                } else {
                    // It doesnt match
                    return false;
                }
            }
        } else // user does not exist
            return false;
    } else //cookies not set return not logged in
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
    while ($unique != true) {
        $rand = getRandom(20);
        $sql = "SELECT * FROM tmp_users WHERE 'hash' = '$rand'";
        $result = $con->query($sql);
        if ($result->num_rows == 0) {
            $unique = true;
        }
    }
    return $rand;
}


/*************************************************
 * Get Ip address
 *
 * Used for various security checks
 ************************************************/

// Function to get the client IP address
function get_client_ip()
{
    $ipaddress = '';
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (!empty($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (!empty($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (!empty($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (!empty($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return ip2long($ipaddress);
    // returns address as an integer
}


/*************************************************
 * Add Failed Login
 *
 * Adds username to failed logins
 ************************************************/

function add_failed_login()
{
    global $con;
    $ip = get_client_ip();
    $sql = "INSERT INTO failed_logins (ip) VALUES ('$ip')";

    if ($con->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}


/*************************************************
 * Check if can login
 *
 * Returns true of false if user can atempt logging in again.
 * checks login attempts to confirm
 ************************************************/
function can_login()
{
    global $con;
    // minutes to lockout
    $lockout_time = 10;
    // the number of failed attempts allowed during lockout time
    $attempt_limit = 15;
    // get ip address
    $ip = get_client_ip();

    // delete outdated failed logins
    $sql = "DELETE FROM failed_logins WHERE failed_time < NOW() - INTERVAL $lockout_time MINUTE";
    if ($con->query($sql) === TRUE) {
        // deleted outdated rows
    } else {
        // failed
    }

    $sql = "SELECT * FROM failed_logins WHERE ip = '$ip' AND failed_time >= NOW() - INTERVAL $lockout_time MINUTE";
    $result = $con->query($sql);
    if ($result->num_rows >= $attempt_limit) {
        // hit failed login limit
        return false;
    } else{
        // has not hit failed login limit
        return true;
    }

}

/*************************************************
 * Check if username available
 *
 * Returns true or false if username is available.
 * Checks tmp users and current users.
 ************************************************/
function username_aval($un){

    // clean up tmp_users database first
    cleanup_tmp_users();

    global $con;
    $username = $un;
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($con, $sql);
    if ($result->num_rows > 0) {
        return false; //already registered
    } else {
        // check tmp_users
        $sql = "SELECT * FROM tmp_users WHERE username='$username'";
        $result = mysqli_query($con, $sql);
        if ($result->num_rows > 0) {
            return false; // registered as tmp user
        } else {
            return true;  //username is available
        }
    }
}

/*************************************************
 * Clean Up tmp_users
 *
 * Deletes tmp_users older than 3 days
 ************************************************/

function cleanup_tmp_users(){
    global $con;
    $sql = "DELETE FROM tmp_users WHERE reg_date < NOW() - INTERVAL 3 DAY";
    if ($con->query($sql) === TRUE) {
        // deleted outdated tmp users
    }
}