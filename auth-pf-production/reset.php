<?php

header('Content-Type: application/json'); //3 party who access this api 
header('Access-Control-Allow-Origin: *'); //*means all website access this api
header('Access-Contro-Allow-Methods: POST'); // use api POST method

$formData = stripcslashes(file_get_contents("php://input"));
$data = json_decode($formData, true);


include "config.php";

// LOGIN CREDENTIALS
$email = $data['email'];
$newPassword = $data['npassword'];
$encryptNewPassword = sha1($newPassword);
$reEnterNewPassword = $data['rpassword'];
$encryptReNewPassword = sha1($reEnterNewPassword);

// CHECK IF TOKEN IS SET AND LOGIN USER ID SET THEN DO PROCESS
if (isset($_COOKIE['token']) && isset($_COOKIE['id'])) {
    $checkUser =  "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $checkUser) or die("Check User For Reset Password  Query Failed");

    if ($newPassword == $reEnterNewPassword) {
        if (mysqli_num_rows($result) > 0) {
            $sql = "UPDATE users SET password='$encryptNewPassword' WHERE email = '$email'";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(array('message' => 'Password Reset Successfully on email ' . $email, 'status' => 'true'));
            } else {
                echo json_encode(array('message' => 'New Password Not Set Successfully', 'status' => 'false'));
            }
        } else {
            echo json_encode(array('message' => 'User Not found on email ' . $email, 'status' => 'false'));
        }
    } else {
        echo json_encode(array('message' => 'Password And Re-enter Password Not Match', 'status' => 'false'));
    }
} else {
    echo json_encode(array('message' => 'Unauthorize User', 'status' => 'false'));
}
