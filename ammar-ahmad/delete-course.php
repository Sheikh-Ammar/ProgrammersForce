<?php
include "conn.php";

session_start();

// NOT EXECUTE SCRIPT FOR THESE ROLES
if ($_SESSION['role'] == 'normal' || $_SESSION['role'] == 'admin') {
    header("Location:http://localhost/ProgrammerForce/ammar-ahmad/login.php");
}

$cid = $_GET['cid'];

$sql = "DELETE FROM courses WHERE cid=$cid";

if (mysqli_query($conn, $sql)) {
    $_SESSION["success"] = "Course Delete Successfully !";
    header("Location:http://localhost/ProgrammerForce/ammar-ahmad/");
} else {
    $_SESSION["error"] = "Course Not Delete Successfully !";
    header("Location:http://localhost/ProgrammerForce/ammar-ahmad/");
}
