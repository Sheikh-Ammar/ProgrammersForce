<?php
//DB CONNECTION CREDENTIALS
$servername = "localhost";
$username = "root";
$password = "";
$database = "auth";

// CREATE CONNECTION
$conn = mysqli_connect($servername, $username, $password, $database);

// CHECK CONNNECTION
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
