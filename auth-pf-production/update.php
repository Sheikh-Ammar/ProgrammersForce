<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Contro-Allow-Methods: POST');

// INCLUE CONNECTION
include "config.php";

// FORM POST ID
$id = $_POST['id'];

// CHECK IF USER IS LOGIN THEN 
if (isset($_COOKIE['token']) && $_COOKIE['id']) {
    // UPDATE NEW PROFILE IMAGE PROCESS
    if ($id && is_uploaded_file($_FILES['image']['tmp_name'])) {
        $tmp_file = $_FILES['image']['tmp_name'];
        $imgName = $_FILES['image']['name'];
        $newImageName  = time() . "-" . $imgName;
        $upload_dir = "./images/" . $newImageName;

        // CHECK PREVIOUS PROFILE IMAGE OF USERS IN RECORED FOR UPDATE
        $getDbImage  = "SELECT image FROM users WHERE id = $id";
        $result = mysqli_query($conn, $getDbImage);
        $row = mysqli_fetch_assoc($result);
        $dbImage = $row['image'];

        if (file_exists("images/$dbImage")) {
            // DELETE EXITS PROFILE IMAGE
            unlink("images/$dbImage");

            // UPDATE DATA
            $sql = "UPDATE users SET image= '{$newImageName}' WHERE id = $id";
            if (move_uploaded_file($tmp_file, $upload_dir) && mysqli_query($conn, $sql)) {
                echo json_encode(array('message' => 'User Profile Image Update Successfully', 'status' => 'true'));
            }
        } else {
            echo json_encode(array('message' => 'User Profile Not Found', 'status' => 'false'));
        }
    } else {
        echo json_encode(array('message' => 'Invalid Request', 'status' => 'false'));
    }
} else {
    echo json_encode(array('message' => '403 | UnAuthorize User', 'status' => 'false'));
}
