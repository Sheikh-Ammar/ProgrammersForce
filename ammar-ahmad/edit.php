<?php include "header.php";

// NOT SHOW PAGE TO THESE ROLES
if ($_SESSION['role'] == 'normal') {
    header("Location:http://localhost/ProgrammerForce/ammar-ahmad/login.php");
}

?>
<div class="container">
    <h1 class="text-center mt-5"><b>Student Managment System | <span class="text-warning">EDIT</span></b></h1>
    <div class="row">
        <div class="col-md-6 offset-3 my-2">
            <?php
            // GET ALL DATA DEPEND ON ID
            include "conn.php";
            $id = $_GET['sid'];
            $sql = "SELECT * FROM students WHERE sid = $id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <form action="editProcess.php?sid=<?= $row["sid"]; ?>" method="POST">
                <div class="mb-3">
                    <label class="form-label">Student Name</label>
                    <input type="text" class="form-control" name="name" required value="<?= $row['sname']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Student Contact</label>
                    <input type="number" class="form-control" name="number" required value="<?= $row['scontact']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Student Cnic</label>
                    <input type="text" class="form-control" name="cnic" required value="<?= $row['scnic']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Student Course</label>
                    <select class="form-select" name="course">
                        <option selected>Courses</option>
                        <?php
                        // SHOW COURSES
                        include "conn.php";
                        $sql = "SELECT * FROM courses";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $value) {
                        ?>
                                <option value="<?= $value['cid']; ?>" <?php if ($value['cid'] == $row['cid']) {
                                                                            echo "selected";
                                                                        } ?>><?= $value['cname']; ?></option>
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
                        // SHOW GRADES
                        include "conn.php";
                        $sql = "SELECT * FROM grades";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $value) {
                        ?>
                                <option value="<?= $value['gid']; ?>" <?php if ($value['gid'] == $row['gid']) {
                                                                            echo "selected";
                                                                        } ?>><?= $value['grades']; ?></option>
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