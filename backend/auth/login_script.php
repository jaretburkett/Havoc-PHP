<?php
include($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');

// todo prevent multipule login attempts

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($con, $sql);
if ($result->num_rows > 0) {
    while($user = $result->fetch_assoc()) {
        $saltypass= crypt($password,$user['salt']);
        if (password_verify($saltypass, $user['password'])) {
            // it matches
            // set cookie
            setcookie("username",$username,time()+31556926 ,'/'); // set cookie for a year
            setcookie("saltypass",$saltypass,time()+31556926 ,'/'); // set cookie for a year
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
        }
    }
} else {
    // username not found
    $response = [
        'code' => '0',
        'message' => 'This username does not exist'
    ];
}

// send back the reply
echo json_encode($response);
