<?php

require_once dirname(__DIR__). "config/db_connection.php";

// model 

class post_model{
    // constuctor call hoga jo db jo or inside db object create hoga.
private $db;
    public function __construct()
    {

    $database = new database();
     $this->db = $database->get_connection();  
    }



    public function create(){
        
    }
}

?>