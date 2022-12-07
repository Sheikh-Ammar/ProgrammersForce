<?php include "header.php"; ?>
<!-- TABLE -->
<div class="container">
    <h1 class="text-center text-white mt-5"><b>Student Managment System</b></h1>
    <div class="row">
        <div class="col-md-12 my-2">
            <?php
            // SUCCESS AND ERROR MESSAGE DISPLAY
            if (isset($_SESSION['success'])) {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?= $_SESSION['success']; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            unset($_SESSION['success']);
            if (isset($_SESSION['error'])) {
            ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?= $_SESSION['error']; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            unset($_SESSION['error']);
            ?>
            <div class="row">
                <!-- SHOW BTN DEPEND ON ROLES -->
                <?php include "conn.php";
                if ($_SESSION['role'] == 'super admin') {
                ?>
                    <div class="col-md-2">
                        <a href="create.php" class="btn btn-block btn-outline-info my-2">Add Student</a>
                    </div>
                    <div class="col-md-2">
                        <a href="courses.php" class="btn btn-block btn-outline-info my-2">Courses</a>
                    </div>
                <?php  } ?>
                <div class="col-md-1">
                    <a href="logout.php" class="btn btn-block btn-outline-info my-2">Logout</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="bg-success text-white">
                            <th scope="col">Name</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Cnic</th>
                            <th scope="col">Course</th>
                            <th scope="col">Grade</th>
                            <!-- SHOW COL DEPEND ON ROLES -->
                            <?php
                            include "conn.php";
                            if ($_SESSION['role'] == 'super admin') {
                            ?>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            <?php  }
                            if ($_SESSION['role'] == 'admin') {
                            ?>
                                <th scope="col">Edit</th>
                            <?php  } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "conn.php";
                        $sql = "SELECT sid ,sname, scontact, scnic, cname, grades FROM students
                            INNER JOIN Courses ON students.cid = Courses.cid
                            INNER JOIN Grades ON students.gid = Grades.gid;";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $value) {
                        ?>
                                <tr class="text-white">
                                    <td><?php echo  $value["sname"]; ?></td>
                                    <td><?php echo  $value["scontact"]; ?></td>
                                    <td><?php echo  $value["scnic"]; ?></td>
                                    <td><?php echo  $value["cname"]; ?></td>
                                    <td><?php echo  $value["grades"]; ?></td>
                                    <!-- SHOW EDIT/DELETE DEPEND ON ROLES -->
                                    <?php
                                    include "conn.php";
                                    if ($_SESSION['role'] == 'super admin') {
                                    ?>
                                        <td><a href="edit.php?sid=<?php echo  $value["sid"]; ?>" class="btn btn-sm btn-warning">Edit</a></td>
                                        <td><a href="delete.php?sid=<?php echo  $value["sid"]; ?>" class="btn btn-sm btn-danger">Delete</a></td>
                                    <?php  }
                                    if ($_SESSION['role'] == 'admin') {
                                    ?>
                                        <td><a href="edit.php?sid=<?php echo  $value["sid"]; ?>" class="btn btn-sm btn-warning">Edit</a></td>
                                    <?php  } ?>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>