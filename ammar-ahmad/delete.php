<?php

include "conn.php";

// NOT EXECUTE SCRIPT FOR THESE ROLES
if ($_SESSION['role'] == 'normal' || $_SESSION['role'] == 'admin') {
    header("Location:http://localhost/ProgrammerForce/ammar-ahmad/login.php");
}

$sid = $_GET['sid'];

$sql = "DELETE FROM students WHERE sid=$sid";

session_start();
if (mysqli_query($conn, $sql)) {
    $_SESSION["success"] = "Delete Successfully !";
    header("Location:http://localhost/ProgrammerForce/ammar-ahmad/");
} else {
    $_SESSION["error"] = "Not Delete Successfully !";
    header("Location:http://localhost/ProgrammerForce/ammar-ahmad/");
}
