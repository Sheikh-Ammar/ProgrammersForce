<?php

header('Content-Type: application/json'); //3 party who access this api to teel them that it return data in json format
header('Access-Control-Allow-Origin: *'); //*means all website access this api
header('Access-Contro-Allow-Methods: DELETE'); // use api POST method

$data = json_decode(file_get_contents("php://input"), true);
//php:input use what we get data in any fromat it read that data

$sid = $data['sid'];

include "config.php";

$sql = "DELETE FROM students WHERE sid=$sid";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array('message' => 'Record Deleted', 'status' => 'true')); // to convert in accociated array for json format  
} else {
    echo json_encode(array('message' => 'Record not Deleted', 'status' => 'false')); // to convert in accociated array for json format
}
