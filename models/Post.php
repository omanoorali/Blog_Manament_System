<?php

require_once dirname(__DIR__) . "/config/db_connection.php";



class post_model
{
    // constuctor call hoga jo db jo or inside db object create hoga.
    private $db;
    public function __construct()
    {

        $database = new database();
        $this->db = $database->get_connection();
    }



    public function create($userId, $categoryId, $title, $content, $feature_image, $published_at)
    {

        $sql = "INSERT INTO post (
            user_id, category_id, title,  content, feature_image, published_at
                     ) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iissss", $userId, $categoryId, $title, $content, $feature_image, $published_at);

        $results = $stmt->execute();
        $stmt->close();
        return $results;
    }


    public function get_all_posts()
    {
        $sql = "SELECT post.*, users.name as user_name, category.name as category_name 
            FROM post 
            LEFT JOIN users ON users.id = post.user_id 
            LEFT JOIN category ON category.id = post.category_id 
            ORDER BY post.id DESC";

        $post_result = mysqli_query($this->db, $sql);

        return $post_result;
    }


    public function get_single_post($id)
    {

        $sql = "SELECT * FROM post WHERE id={$id}";
        $single_Result = mysqli_query($this->db, $sql);
        return $single_Result = mysqli_fetch_assoc($single_Result);
    }

    public function update($userId, $categoryId, $title, $content, $feature_image, $published_at, $post_id)
    {
        $sql = "UPDATE post SET user_id=?, category_id=? , title=? , content=?, feature_image=?, published_at=? WHERE id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iissssi", $userId, $categoryId, $title, $content, $feature_image, $published_at, $post_id);
        $post_updated = $stmt->execute();
        $stmt->close();
        return $post_updated;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM post WHERE id={$id}";

        $result = mysqli_query($this->db, $sql);
        return $result;
    }


    // show users drowpdown


    public function authanticated()
    {

        $sql = "SELECT users.id,users.name FROM users JOIN role ON users.role_id=role.id WHERE role.role_name IN ('admin','Author')";

        $result = mysqli_query($this->db, $sql);

        return $result;
    }
    public function categories()
    {

        $sql = "SELECT * FROM category WHERE status='1'";
        $categories = mysqli_query($this->db, $sql);
        return $categories;
    }

    

   // for  pagination 

    public function get_all_home_post($page_num = 1, $limit = 3)
    {
        $page_num = (int)$page_num;
        $limit = (int)$limit;
        $offset = ($page_num - 1) * $limit;

        $sql = "SELECT post.*, 
                   users.name as author_name, 
                   users.profile_image as author_image, 
                   category.name as category_name 
            FROM post 
            INNER JOIN users ON users.id = post.user_id 
            INNER JOIN category ON category.id = post.category_id 
            ORDER BY post.id DESC 
            LIMIT $limit OFFSET $offset";

        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    // 2. Yeh NAYA function model mein add karein:
    public function get_total_posts_count()
    {
        $sql = "SELECT COUNT(id) AS total FROM post";
        $result = mysqli_query($this->db, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
    // show cat dropwdown




    // for  inner page function 

    public function inner_page($id){

        $sql = "SELECT post.*, 
                       users.name as author_name, 
                       users.profile_image as author_image, 
                       category.name as category_name 
                FROM post 
                INNER JOIN users ON users.id = post.user_id 
                INNER JOIN category ON category.id = post.category_id 
                WHERE post.id='$id' LIMIT 1";

        $result = mysqli_query($this->db, $sql);

        return $result;
    }



    // for users 

        public function get_users_deshboard(){
        $sql = "SELECT users.*,  
                       role.role_name as user_role

                FROM users 
                INNER JOIN role ON role.id = users.role_id
                ORDER BY users.id DESC";

        $result = mysqli_query($this->db, $sql);

        return $result;
    }

// catgory_post
    public function get_category_deshboard(){

         $sql = "SELECT post.*,  
                       category.name as category_name 
                FROM post 
                INNER JOIN category ON category.id = post.category_id 
               ORDER BY post.id DESC";

        $result = mysqli_query($this->db, $sql);

        return $result;
    }

}
