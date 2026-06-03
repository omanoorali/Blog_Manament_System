<?php

require_once dirname(__DIR__) . "/config/db_connection.php";

class User 
{
    public $db;

    public function __construct()
    {
        $db_obj = new database(); 
        $this->db = $db_obj->get_connection();
    }

    public function create($name, $email, $password,  $phone_number, $profile_image, $role_id)
    {
        // MySQLi Prepared Statement (?) ke sath
        $sql = "INSERT INTO users (name, email, password, phone_number, profile_image,role_id) VALUES (?, ?, ?, ?, ?,?)";
        
        $stmt = $this->db->prepare($sql);
        
        if ($stmt === false) {
            die("SQL Prepare Failed: " . $this->db->error);
        }

        // 5 Strings ko bind karna ("sssss")
        $stmt->bind_param("ssssss", $name, $email, $password, $phone_number, $profile_image,$role_id);

        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    }
}