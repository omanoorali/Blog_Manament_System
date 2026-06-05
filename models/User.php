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
        $sql = "INSERT INTO users (name, email, password, phone_number, profile_image,role_id) VALUES (?, ?, ?, ?, ?,?)";
        
        $stmt = $this->db->prepare($sql);
        
        if ($stmt === false) {
            die("SQL Prepare Failed: " . $this->db->error);
        }

        $stmt->bind_param("ssssss", $name, $email, $password, $phone_number, $profile_image,$role_id);

        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    }

    public function get_all_users(){
        $sql = "SELECT users.id AS user_id, users.name, users.email, users.password, users.phone_number, users.profile_image, role.role_name,role.id as role_id FROM users INNER JOIN role ON users.role_id = role.id";
        $result = mysqli_query($this->db,$sql);
       return $result;
    }



    public function get_single_user($id){

    $sql = "SELECT * FROM users Where id={$id}";

    $result = mysqli_query($this->db,$sql);

    return $result=mysqli_fetch_assoc($result);

    }


   public function update($name, $email, $password, $phone_number, $profile_image, $role_id, $id) {
    // 1. SQL Query mein 'role_id=?' ko bhi add kiya aur placeholders ko sahi kiya
    $sql = "UPDATE users SET name=?, email=?, password=?, phone_number=?, profile_image=?, role_id=? WHERE id=?";

    $stmt = $this->db->prepare($sql);

        $stmt->bind_param("ssssssi", $name, $email, $password, $phone_number, $profile_image, $role_id, $id);

        $result = $stmt->execute();

        $stmt->close();

        return $result; 

    
}

   public function delete($id){
    // 'FROM' keyword add kar diya gaya hai
    $sql = "DELETE FROM users WHERE id={$id}";
    $result = mysqli_query($this->db, $sql);
    
    return $result;
}

}