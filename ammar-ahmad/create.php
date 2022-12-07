<?php include "header.php";

// NOT SHOW PAGE TO THESE ROLES
if ($_SESSION['role'] == 'normal' || $_SESSION['role'] == 'admin') {
    header("Location:http://localhost/ProgrammerForce/ammar-ahmad/login.php");
}

?>
<div class="container">
    <h1 class="text-center mt-5"><b>Student Managment System | <span class="text-primary">CREATE</span></b></h1>
    <div class="row">
        <div class="col-md-6 offset-3 my-2">
            <form action="createProcess.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Student Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Student Contact</label>
                    <input type="number" class="form-control" name="number" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Student Cnic</label>
                    <input type="text" class="form-control" name="cnic" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Student Course</label>
                    <select class="form-select" name="course">
                        <option selected>Courses</option>
                        <?php
                        // COURSES SHOWS
                        include "conn.php";
                        $sql = "SELECT * FROM courses";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $value) {
                        ?>
                                <option value="<?= $value['cid']; ?>"><?= $value['cname']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Student Grade</label>
                    <select class="form-select" name="grade">
                        <option selected>Grades</option>
                        <?php
                        // GRADES SHOWS
                        include "conn.php";
                        $sql = "SELECT * FROM grades";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $value) {
                        ?>
                                <option value="<?= $value['gid']; ?>"><?= $value['grades']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <input type="submit" name="submit" class="btn btn-sm btn-primary">
            </form>
            <a href="index.php" class="btn btn-sm btn-info my-2">Home</a>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>