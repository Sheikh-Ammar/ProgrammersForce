<?php
include "header.php";

// NOT EXECUTE SCRIPT FOR THESE ROLES
if ($_SESSION['role'] == 'normal' || $_SESSION['role'] == 'admin') {
    header("Location:http://localhost/ProgrammerForce/ammar-ahmad/login.php");
}

// GET COURSE DEPEND ON ID
include "conn.php";
$cid = $_GET['cid'];
$sql = "SELECT * FROM courses WHERE cid = $cid";
$result = mysqli_query($conn, $sql);
$value = mysqli_fetch_assoc($result);
?>
<div class="container my-3">
    <div class="row">
        <h1 class="text-center mt-5"><b>Student Managment System | <span class="text-primary">EDIT COURSE</span></b></h1>
        <div class="col-md-6 offset-2 mt-5">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?cid=<?php echo $value['cid'] ?>" method="POST">
                <div class="mb-3">
                    <label class="form-label">Course Name</label>
                    <input type="text" class="form-control" name="cname" required value="<?= $value['cname'] ?>">
                </div>
                <input type="submit" name="submit" class="btn btn-sm btn-primary">
            </form>
            <a href="index.php" class="btn btn-sm btn-info my-2">Home</a>
        </div>
    </div>
</div>

<?php
// UPDATE COURSE
if (isset($_POST['submit'])) {
    $cname = $_POST['cname'];

    echo $sql = "UPDATE courses SET cname='$cname' WHERE cid=$cid";
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