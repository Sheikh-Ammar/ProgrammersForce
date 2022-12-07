<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>SMS | Login</title>
</head>

<body class="bg-dark">
    <h1 class="text-center text-white mt-5"><b>Student Managment System</b></h1>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 offset-4 mt-3 bg-light p-5 border border-warning border-5 rounded-top">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <button type="submit" name="submit" class="btn btn-block btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>


<?php
// MATCH INFO FROM DB AND REDIRECT
include "conn.php";

session_start();

// SESSION SET NOT SHOW LOGIN AGAIN
if (isset($_SESSION['email'])) {
    header("Location:http://localhost/ProgrammerForce/ammar-ahmad/");
}

if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        echo
        "<script>
        alert('Please Fill All Fields');
        </script>";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT email, password, role FROM users WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $row['role'];
            header("Location:http://localhost/ProgrammerForce/ammar-ahmad/");
        } else {
            echo
            "<script>
            alert('Invalid Email Or Password');
            </script>";
        }
    }
}
?>