<?php

// HOME CONTROLLER
class Users extends Controller
{
    protected $user;

    // MAKE OBJECT OF USER MODEL
    public function __construct()
    {
        $this->user = $this->model('User');
    }


    // SHOW HOME PAGE WITH DATA
    public function index()
    {
        $conn =  $this->dbConnection();
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) :
            foreach ($result as $value) :
                $data = ['email' => $value['email'], 'password' => $value['password']];
                $this->view('users', $result);
            endforeach;
        else :
            $this->view('users', $result);
        endif;
    }

    // SHOW ADD USER PAGE
    public function create()
    {
        $this->view('addUser');
    }

    // STORE USER INFO IN DB AND REDIRECT TO Home PAGE
    public function store()
    {
        $conn =  $this->dbConnection();

        $email =  $_GET['email'];
        $password = $_GET['password'];
        $role =  $_GET['role'];

        if (empty($email) || empty($password) || empty($role)) {
            header("location: http://localhost/ProgrammerForce/ammar-mvc/public/users");
        } else {
            $sql = "INSERT INTO users (email, password, role)
                VALUES ('$email','$password','$role')";

            if (mysqli_query($conn, $sql)) {
                header("location: http://localhost/ProgrammerForce/ammar-mvc/public/users");
            }
        }
    }

    // SHOW EDIT USER PAGE WITH INFO OF GIVEN USER ID
    public function edit($id)
    {
        $conn =  $this->dbConnection();
        $Uid = $id;

        $sql = "SELECT * FROM users WHERE uid = $Uid";
        $result = mysqli_query($conn, $sql);
        $row =  mysqli_fetch_assoc($result);

        $this->user->id = $row['uid'];
        $this->user->email = $row['email'];
        $this->user->password = $row['password'];

        $data = ['uid' => $this->user->id, 'email' => $this->user->email, 'password' => $this->user->password];
        $this->view('editUser', $data);
    }

    // UPDATE USER INFO AND REDIRECT TO Home PAGE
    public function update($id)
    {
        $conn =  $this->dbConnection();

        $Uid = $id;
        $email =  $_GET['email'];
        $password = $_GET['password'];

        $sql = "UPDATE users SET email='$email', password='$password' WHERE uid=$Uid";

        if (mysqli_query($conn, $sql)) {
            header("location: http://localhost/ProgrammerForce/ammar-mvc/public/users");
        }
    }

    // DELETE GIVEN ID USER
    public function delete($id)
    {
        $conn =  $this->dbConnection();
        $Uid = $id;

        $sql = "DELETE FROM users WHERE uid=$Uid";

        if (mysqli_query($conn, $sql)) {
            header("location: http://localhost/ProgrammerForce/ammar-mvc/public/users");
        }
    }
}
