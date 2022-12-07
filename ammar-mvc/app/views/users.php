<?php include 'layouts/header.php'; ?>


<div class="container mt-5">
    <div class="row">
        <h1 class="text-center">This is USERS PAGE</h1>
        <div class="col-md-8 offset-2 mt-5">
            <h3>Users Data :</h3>
            <a href="/ProgrammerForce/ammar-mvc/public/users/create/" class="btn btn-sm btn-info my-3">AddUser</a>
            <div class="table-reposnsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                            <th scope="col">Role</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $value) :
                        ?>
                            <tr>
                                <td><?= $value['email'] ?></td>
                                <td><?= $value['password'] ?></td>
                                <td><?= $value['role'] ?></td>
                                <td><a href="/ProgrammerForce/ammar-mvc/public/users/edit/<?php echo $value['uid'] ?>" class="btn btn-sm btn-warning">Edit</a></td>
                                <td><a href="/ProgrammerForce/ammar-mvc/public/users/delete/<?php echo $value['uid'] ?>" class="btn btn-sm btn-danger">Delete</a></td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include  'layouts/footer.php' ?>