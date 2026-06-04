<?php

require_once dirname(__DIR__) . "/config/db_connection.php";

class model_role{
    private $db;

    public function __construct()
    {
        $database = new database();
        $this->db = $database->get_connection();
    }

    public function create($role_name){

     $sql = "INSERT INTO role(role_name) VALUES(?)";
     // query ko execute karne k lia yahn perpare statiment h

     $stmt = $this->db->prepare($sql);
     if($stmt === false){
        die("role query faild".$this->db->error);
     }

     $stmt->bind_param("s", $role_name);

     $result = $stmt->execute();
     $stmt->close();
     return  $result;


    }

    public function get_all_roles(){


    $sql = "SELECT * FROM role";
    $result = mysqli_query($this->db,$sql);
    return $result;

    }
// edit side se id send karne h or yana query run hogi.
// or data get karke data retrun kar donga use method p
    public function get_sigle_id($id){

        $sql ="SELECT * FROM role WHERE id={$id}";// core php
        $result =  mysqli_query($this->db,$sql);
        return $result;


    



    }


    public function update($role,$role_id){
        $sql = "UPDATE role set role_name = ? WHERE id=?";
        $stmt = $this->db->prepare($sql);
        if($stmt === false){
            die("updted faild");
        }
        $stmt->bind_param("si",$role,$role_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
        
    }
   


    public function delete($id){
       $sql  = "DELETE FROM role WHERE id = {$id}";
       $result =  mysqli_query($this->db,$sql);
       return $result;

    }



}

?>