<?php

// INCLUE HEADERS
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Contro-Allow-Methods: POST');

// INCLUDE CONNECTION
include "config.php";

// SIGUN CREDENTIALS
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$encryptPassword = sha1($password);
$age = $_POST['age'];
$gender = $_POST['gender'];

// SIGN UP STORE PROCEDURE
if (is_uploaded_file($_FILES['image']['tmp_name']) && $name  && $email && $password  && $age && $gender) {
    $tmp_file = $_FILES['image']['tmp_name'];
    $imgName = $_FILES['image']['name'];
    $newImageName  = time() . "-" . $imgName;
    $upload_dir = "./images/" . $newImageName;
    $sql = "INSERT INTO users (name, email, password, age, gender, image)
    VALUES ('{$name}', '{$email}', '{$encryptPassword}', {$age}, '{$gender}', '{$newImageName}')";
    if (move_uploaded_file($tmp_file, $upload_dir) && mysqli_query($conn, $sql)) {
        echo json_encode(array('message' => 'User sign up successfull', 'status' => 'true'));
    } else {
        echo json_encode(array('message' => 'User not sign up successfull', 'status' => 'false'));
    }
} else {
    echo json_encode(array('message' => 'Invalid Request', 'status' => 'false'));
}
