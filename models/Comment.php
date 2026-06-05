<?php
require_once dirname(__DIR__) . "config/db_connection.php";

class category_model{

   private $db;
    public function __construct()
    {

        $database = new database();
        $this->db = $database->get_connection();
    }

    public function create(){

    }

    public function update(){

    }

    public function delete(){
        
    }

}


?>