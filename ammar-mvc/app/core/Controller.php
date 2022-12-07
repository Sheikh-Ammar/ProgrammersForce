<?php

// MAIN CONTROLLER
class Controller
{
    // DB CONNECTION CREDENTIALS
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbname = "sms";

    // DB CONNECTION MAKE
    public function dbConnection()
    {
        $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            return $conn;
        }
    }

    // RETURN MODEL CLASS WHICH PASS AS A PARAMETER TO ANY CONTROLLER
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    // DISPLAY VIEW AND DATA WHICH USE IN VIEW
    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }
}
