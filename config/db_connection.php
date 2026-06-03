<?php

class database
{
    private $localhost = "localhost";
    private $root = "root";
    private $password = "";
    private $database = "job_portal_db";


    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->localhost, $this->root, $this->password, $this->database);

        if ($this->conn->connect_error) {
            // echo "database connection faild". $this->conn->connect_error;
            die("database connection faild". $this->conn->connect_error);
        }
    }

    public function get_connection(){
        return $this->conn;
        // echo "connecton ok";
    }
}

// $connect =  new database();
// $connect->get_connection();

?>