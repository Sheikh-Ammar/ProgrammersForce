<?php include "header.php";

// NOT SHOW PAGE TO THESE ROLES
if ($_SESSION['role'] == 'normal' || $_SESSION['role'] == 'admin') {
    header("Location:http://localhost/ProgrammerForce/ammar-ahmad/login.php");
}

?>
<div class="container my-3">
    <div class="row">
        <h1 class="text-center mt-5"><b>Student Managment System | <span class="text-primary">COURSES</span></b></h1>
        <div class="col-md-4 mt-5">
            <div class="table-responsive">
                <table class="table text-white">
                    <thead>
                        <tr class="bg-success">
                            <th scope="col">#</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // GET ALL COURSES DATA
                        include "conn.php";
                        $sql = "SELECT * FROM courses";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $value) {
                        ?>
                                <tr>
                                    <th scope="row"><?= $value['cid'] ?></th>
                                    <td><?= $value['cname'] ?></td>
                                    <td><a href="edit-course.php?cid=<?php echo  $value["cid"]; ?>" class="btn btn-sm btn-warning">Edit</a></td>
                                    <td><a href="delete-course.php?cid=<?php echo  $value["cid"]; ?>" class="btn btn-sm btn-danger">Delete</a></td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6 offset-2 mt-5">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="mb-3">
                    <label class="form-label">Course Name</label>
                    <input type="text" class="form-control" name="cname" required>
                </div>
                <input type="submit" name="submit" class="btn btn-sm btn-primary">
            </form>
            <a href="index.php" class="btn btn-sm btn-info my-2">Home</a>
        </div>
    </div>
</div>

<?php
// ADD COURSE
if (isset($_POST['submit'])) {
    $cname = $_POST['cname'];

    $sql = "INSERT INTO courses (cname)
    VALUES ('$cname')";
    session_start();
    if (mysqli_query($conn, $sql)) {
        $_SESSION["success"] = "Course Create Successfully !";
        header("Location:http://localhost/ProgrammerForce/ammar-ahmad/");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        $_SESSION["error"] = "Course Not Create Successfully !";
        header("Location:http://localhost/ProgrammerForce/ammar-ahmad/");
    }
}
?>
<?php include "footer.php"; ?>