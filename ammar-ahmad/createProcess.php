<?php
include "conn.php";

session_start();

// NOT EXECUTE SCRIPT FOR THESE ROLES
if ($_SESSION['role'] == 'normal' || $_SESSION['role'] == 'admin') {
    header("Location:http://localhost/ProgrammerForce/ammar-ahmad/login.php");
}

$name = $_POST["name"];
$contact = $_POST["number"];
$cnic = $_POST["cnic"];
$course = $_POST["course"];
$grade = $_POST["grade"];

$sql = "INSERT INTO students (sname, scontact, scnic, cid, gid)
    VALUES ('$name', '$contact', '$cnic', $course, '$grade')";
session_start();
if (mysqli_query($conn, $sql)) {
    $_SESSION["success"] = "Create Successfully !";
    header("Location:http://localhost/ProgrammerForce/ammar-ahmad/");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    $_SESSION["error"] = "Not Create Successfully !";
    header("Location:http://localhost/ProgrammerForce/ammar-ahmad/");
}
