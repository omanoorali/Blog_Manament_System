<?php

//id	name	slug	descrption	status	create_at	update_at	

require_once dirname(__DIR__) . "/config/db_connection.php";

class category_model{

   private $db;
    public function __construct()
    {

        $database = new database();
        $this->db = $database->get_connection();
    }

    public function create($name,$descrption,$status){
        $sql = "INSERT INTO category(name,descrption,status) value(?,?,?)";

        $stmt = $this->db->prepare($sql);

        $stmt->bind_param("sss",$name,$descrption,$status);

        $result =$stmt->execute();
        $stmt->close();

        return $result;

    }

    public function get_all_cat(){

    $sql = "SELECT * FROM category";
    $result = mysqli_query($this->db,$sql);
    return $result;


    }

    public function get_data_by_cat_id($id){
        $sql = "SELECT * FROM category where id={$id}";
    $result = mysqli_query($this->db,$sql);
    return $result;
    }

    public function get_signle_cat($id){

    $sql = "SELECT * FROM category WHERE id={$id}";

    $result = mysqli_query($this->db,$sql);
    return $result=mysqli_fetch_assoc($result);

    }

    public function update($name,$descrption,$status,$id){

    $sql = "UPDATE category SET name=?,descrption=?,status=? WHERE id=?";
    $stmt= $this->db->prepare($sql);
    $stmt->bind_param("sssi",$name,$descrption,$status,$id);
     $result= $stmt->execute();
     $stmt->close();

     return $result;
    }

    public function delete($id){

    $sql = "DELETE FROM  category WHERE id={$id}";
    $result = mysqli_query($this->db,$sql);
    return $result;

        
    }

}


?>