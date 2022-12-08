<?php
// INCLUE HEADERS
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Contro-Allow-Methods: POST');

// CLEAN AND DECODE JSON DATA
$formData = stripcslashes(file_get_contents("php://input"));
$data = json_decode($formData, true);

// INCLUDE CONNECTION
include "config.php";

// LOGIN CREDENTIALS
$email = $data['email'];
$password = $data['password'];
$encryptPassword = sha1($password);

// TOKEN CREDENTIALS
$token = "token";
$id = "id";
$bytes = random_bytes(20);
$tokenValue = bin2hex($bytes);


// IF USER NOT LOGIN THEN DO PROCESS
if (!isset($_COOKIE['token'])) {
    $sql = "SELECT id,email, password FROM users WHERE email = '$email' AND password = '$encryptPassword'";
    $result = mysqli_query($conn, $sql) or die("Check Login Query Failed");

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $idValue = $row['id'];

        echo json_encode(array('message' => 'User Login Successfully ' . $email, 'status' => 'true'));
        // SET TOKEN AND USER ID
        setcookie($token, $tokenValue, time() + 180, "/"); // 7200
        setcookie($id, $idValue, time() + 180, "/");
        echo json_encode(array('token' => $token, 'tokenValue' => $tokenValue));
    } else {
        echo json_encode(array('message' => 'User Not found', 'status' => 'false'));
    }
} else {
    echo json_encode(array('message' => 'You Are Alraedy Login', 'status' => 'false'));
}
