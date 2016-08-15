<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/application/core/database.php';

class AdminRepository
{
    private $validCookie = '610fe7eb-7cbe-43ef-ab9d-f77d29c20ed7';

    public function login($username, $pwd){
        $db = new Database();
        $db->CreateConnection();

        $sql = "SELECT * FROM admins WHERE username='".$username."' AND password='".$pwd."'";
        $result = $db->connection->query($sql);
        if ($result->num_rows == 1) {
            setcookie("auth", $this->validCookie, time()+3600, "/");
            $db->CloseConnection();
            return true;
        }
        $db->CloseConnection();
        return array();
    }

    public function isAuth(){
        return array_key_exists('auth', $_COOKIE) && $_COOKIE["auth"] == $this->validCookie;
    }
}