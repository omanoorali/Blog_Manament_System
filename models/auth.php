<?php


require_once dirname(__DIR__) . "/config/db_connection.php";



class Auth
{
    private $db;

    public function __construct()
    {
        $database = new database();
        $this->db = $database->get_connection();
    }
    public function login($user)
    {
        $_SESSION['user'] = [
            'id'   => $user['id'],
            'name' => $user['name'],
            'role' => $user['role_name']
        ];
    }

    public function attemptLogin($email, $password)
    {
        $sql = "SELECT * FROM users INNER JOIN role ON users.role_id = role.id WHERE users.email='{$email}' AND users.password='{$password}'";
        $result = mysqli_query($this->db,$sql);
                return  $result = mysqli_fetch_assoc($result);
    }

     public function isAdmin()
    {
        return isset($_SESSION['user']) &&
            $_SESSION['user']['role'] == 'admin';
    }


   public function logout()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION = array();

    session_destroy();
}

}
