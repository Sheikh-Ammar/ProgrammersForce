<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>SMS</title>
</head>

<body class="bg-dark text-white">

    <?php
    // SESSION NOT SET NOT SHOW ALL PAGES
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location:http://localhost/ProgrammerForce/ammar-ahmad/login.php");
    }
    ?>