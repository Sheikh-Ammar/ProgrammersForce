<?php

// INCLUE HEADERS
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Contro-Allow-Methods: POST');

// CLEAN AND DECODE JSON DATA
$formData = stripcslashes(file_get_contents("php://input"));
$data = json_decode($formData, true);

// INCLUE CONNECTION
include "config.php";

// FORGET PASSWORD DATA
$email = $data['email'];
$password = $data['password'];
$encryptPassword = md5($password);

// USER FORGET PASSWORD SO THEN DO PROCESS
$getEmail = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $getEmail) or die("Get Email Query Failed");

if (mysqli_num_rows($result) > 0) {
    $sql = "UPDATE users SET  password='$encryptPassword' WHERE email='$email'";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('message' => 'New Password Set Successfully for email ' . $email, 'status' => 'true'));
    } else {
        echo json_encode(array('message' => 'New Password Set Successfully', 'status' => 'false'));
    }
} else {
    echo json_encode(array('message' => 'User Not found', 'status' => 'false'));
}
