<?php


require_once dirname(__DIR__) . "/config/db_connection.php";



class Auth
{
    private $db;

public function _consturct(){
    $database = new database();
    $this->db = $database->get_connection();

}
    public function login($user)
    {
        $_SESSION['user'] = [
            'id'   => $user['id'],
            'name' => $user['name'],
            'role' => $user['role']
        ];
    }

    public function logout()
    {
        session_destroy();
    }

    public function check()
    {
        return isset($_SESSION['user']);
    }

    public function isAdmin()
    {
        return isset($_SESSION['user']) &&
               $_SESSION['user']['role'] == 'admin';
    }

    public function user()
    {
        return $_SESSION['user'];
    }
}

?>