<?php
// include database connection
include_once($_SERVER['DOCUMENT_ROOT'] . '/config/connect.php');
include($_SERVER['DOCUMENT_ROOT'] . '/backend/auth/auth_functions.php');

$userID = $_POST['userID'];
$userID = mysqli_real_escape_string($con, $userID);
$hash = $_POST['hash'];
$hash = mysqli_real_escape_string($con, $hash);
$password = $_POST['password'];
$password = mysqli_real_escape_string($con, $password);

// check if they reset link was valid
$sql = "SELECT * FROM forgot_pass WHERE userID = '$userID'";
$result = mysqli_query($con, $sql);
if ($result->num_rows > 0) {
    while ($user = $result->fetch_assoc()) {
        $userhash = $user['hash'];
    }
}
// make sure hash matches
if ($hash != $userhash) {
    // doesnt match. They are possibly bypassing the form. Hacking?
    $response = [
        'code' => '0',
        'message' => 'Error. Something went wrong.'
    ];
    echo json_encode($response);
    die();
}

// generate new salt
$salt = getSalt();
// make saltypass
$saltypass= crypt($password,$salt);
// generate new hashed password
$storePass = password_hash($saltypass, PASSWORD_DEFAULT);

$sql = "UPDATE users SET salt = '$salt', password = '$storePass' WHERE id = '$userID'";

if (mysqli_query($con, $sql)) {
    // record changed
} else {
    // something went wrong
    $response = [
        'code' => '0',
        'message' => 'Error:'. mysqli_error($con)
    ];
    echo json_encode($response);
    die();
}

// sql to delete a record
$sql = "DELETE FROM forgot_pass WHERE userID = '$userID'";

if ($con->query($sql) === TRUE) {
    // deleted link from forgot_pass table
} else {
    // something went wrong
    $response = [
        'code' => '0',
        'message' => 'Error:'. mysqli_error($con)
    ];
    echo json_encode($response);
    die();
}

// everything is good send acknowledgement
$response = [
    'code' => '1',
    'message' => 'Password updated. You will now be redirected to the login page.'
];
echo json_encode($response);
