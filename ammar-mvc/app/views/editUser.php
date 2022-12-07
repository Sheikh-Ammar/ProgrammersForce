<?php include 'layouts/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <h1 class="text-center">Edit User Page</h1>
        <div class="col-md-8 offset-2 mt-5">
            <form action="/ProgrammerForce/ammar-mvc/public/users/update/<?php echo $data['uid']; ?>" method="GET">
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" name="password" class="form-control" value="<?php echo $data['password']; ?>">
                </div>
                <input type="submit" name="submit" class=" btn btn-primary">
            </form>
        </div>
    </div>
</div>

<?php include  'layouts/footer.php' ?>