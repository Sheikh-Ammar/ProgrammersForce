<?php

header('Content-Type: application/json'); //3 party who access this api to teel them that it return data in json format
header('Access-Control-Allow-Origin: *'); //*means all website access this api
header('Access-Contro-Allow-Methods: PUT'); // use api PUT method

$data = json_decode(file_get_contents("php://input"), true);

$sid = $data['sid'];
$name = $data['sname'];
$contact = $data['scontact'];
$cnic = $data['scnic'];
$course = $data['course'];
$grade = $data['grade'];

include "config.php";

$sql = "UPDATE students SET sname='$name', scontact='$contact', scnic='$cnic', cid=$course, gid=$grade WHERE sid=$sid";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array('message' => 'Student Record updated', 'status' => 'true')); // to convert in accociated array for json format
} else {
    echo json_encode(array('message' => 'Student Record not updated', 'status' => 'false')); // to convert in accociated array for json format
}
