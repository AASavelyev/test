<?php

class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "1111";
    private $dbname = "GuestBook";
    public $connection;

    public function CreateConnection(){
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }

    public function CloseConnection(){
        $this->connection->close();
    }
}