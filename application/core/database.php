<?php

class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "1111";
    private $dbname = "GuestBook";
    public $connection;

    public function CreateConnection(){
        $this->connection = new PDO("mysql:host=localhost;dbname=GuestBook", $this->username, $this->password);
    }

    public function CloseConnection(){
        $connection = null;
    }
}