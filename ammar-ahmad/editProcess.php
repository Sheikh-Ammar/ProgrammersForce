<?php
include "conn.php";

session_start();

// NOT EXECUTE SCRIPT FOR THESE ROLES
if ($_SESSION['role'] == 'normal') {
    header("Location:http://localhost/ProgrammerForce/ammar-ahmad/login.php");
}

$sid = $_GET['sid'];
$name = $_POST["name"];
$contact = $_POST["number"];
$cnic = $_POST["cnic"];
$course = $_POST["course"];
$grade = $_POST["grade"];

$sql = "UPDATE students SET sname='$name', scontact='$contact', scnic='$cnic', cid=$course, gid=$grade WHERE sid=$sid";

session_start();
if (mysqli_query($conn, $sql)) {
    $_SESSION["success"] = "Update Successfully !";
    header("Location:http://localhost/ProgrammerForce/ammar-ahmad/");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    $_SESSION["success"] = "Not Update Successfully !";
    header("Location:http://localhost/ProgrammerForce/ammar-ahmad/");
}
