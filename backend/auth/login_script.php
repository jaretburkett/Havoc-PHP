<?php
include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');
include($_SERVER['DOCUMENT_ROOT'] . '/backend/auth/auth_functions.php');

$username = $_POST['username'];
$username = mysqli_real_escape_string($con, $username);
$password = $_POST['password'];
$password = mysqli_real_escape_string($con, $password);

if(!can_login()){
    // user has hit max failed login attempts (15) in 10 minutes
    $response = [
        'code' => '0',
        'message' => 'Too many unsuccessful login attempts. You have been locked out for 10 minutes.'
    ];
    // add another failed login attempt to shut down brute force
    add_failed_login();
} else {
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($con, $sql);
    if ($result->num_rows > 0) {
        while ($user = $result->fetch_assoc()) {
            $saltypass = crypt($password, $user['salt']);
            if (password_verify($saltypass, $user['password'])) {
                // it matches
                // set cookie
                setcookie("username", $username, time() + 31556926, '/'); // set cookie for a year
                setcookie("saltypass", $saltypass, time() + 31556926, '/'); // set cookie for a year
                $response = [
                    'code' => '1',
                    'message' => 'Success. Logging you in.'
                ];
            } else {
                // It doesnt match
                $response = [
                    'code' => '0',
                    'message' => 'Username and password combination do not match our records.'
                ];
                // add unsuccessful login attempt to database
                add_failed_login();
            }
        }
    } else {
        // username not found
        $response = [
            'code' => '0',
            'message' => 'This username does not exist'
        ];
        // add unsuccessful login attempt to database
        add_failed_login();
        if(!can_login()){
            // user has hit max failed login attempts in 10 minutes
            $response = [
                'code' => '0',
                'message' => 'Too many unsuccessful login attempts. You have been locked out for 10 minutes.'
            ];
        }
    }
}

// send back the reply
echo json_encode($response);
