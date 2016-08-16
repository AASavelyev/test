<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/application/core/database.php';

class AdminRepository
{
    private $validCookie = '610fe7eb-7cbe-43ef-ab9d-f77d29c20ed7';

    public function login($username, $pwd){
        $db = new Database();
        $db->CreateConnection();

        $sth = $db->connection->prepare("SELECT * FROM admins WHERE username=? AND password=?");
        $sth->execute(array($username, $pwd));
        $result = $sth->fetchAll();
        $db->CloseConnection();
        $sth = null;
        if (count($result) == 1){
            setcookie("auth", $this->validCookie, time()+3600, "/");
            return true;
        }
        return false;
    }

    public function isAuth(){
        return array_key_exists('auth', $_COOKIE) && $_COOKIE["auth"] == $this->validCookie;
    }
}