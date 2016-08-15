<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/application/models/comment.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/application/core/database.php';

class CommentRepository
{
    public function getApproved(){
        $db = new Database();
        $db->CreateConnection();

        $sql = "SELECT * FROM comments WHERE IsApproved=1";
        $result = $db->connection->query($sql);
        if ($result->num_rows > 0) {
            $comments = array();
            while($row = $result->fetch_assoc()) {
                $comments[] = new Comment($row);
            }
            return $comments;
        } else {
            return array();
        }
        $db->CloseConnection();
    }

    public function getAll(){
        $db = new Database();
        $db->CreateConnection();

        $sql = "SELECT * FROM comments";
        $result = $db->connection->query($sql);
        if ($result->num_rows > 0) {
            $comments = array();
            while($row = $result->fetch_assoc()) {
                $comments[] = new Comment($row);
            }
            return $comments;
        } else {
            return array();
        }
        $db->CloseConnection();
    }

    private function preventSqlInjection($link, $str){
        return mysqli_real_escape_string($link, $str);
    }

    public function create(Comment $comment){
        $db = new Database();
        $db->CreateConnection();
        $username = $this->preventSqlInjection($db->connection, $comment->username);
        $email = $this->preventSqlInjection($db->connection, $comment->email);
        $site = $this->preventSqlInjection($db->connection, $comment->site);
        $text = $this->preventSqlInjection($db->connection, $comment->text);
        $browserInfo = $this->preventSqlInjection($db->connection, $comment->browserInfo);
        $sql = "INSERT INTO comments (Username, Email, Site, Text, IsApproved, IP, BrowserInfo)
                VALUES ('".$username."', '".$email."', '".$site."', '".$text
            ."', 0, '".$comment->ip."', '".$browserInfo."')";
        $success = $db->connection->query($sql);
        $db->CloseConnection();
        return $success;
    }

    public function update(Comment $comment){
        $db = new Database();
        $db->CreateConnection();
        $username = $this->preventSqlInjection($db->connection, $comment->username);
        $email = $this->preventSqlInjection($db->connection, $comment->email);
        $site = $this->preventSqlInjection($db->connection, $comment->site);
        $text = $this->preventSqlInjection($db->connection, $comment->text);
        $sql = "UPDATE comments SET Username='".$username."',Email='".$email."',Site='".$site."',Text='".$text."' WHERE Id=".$comment->id;
        $success = $db->connection->query($sql);
        $db->CloseConnection();
        return $success;
    }

    public function approve($id){
        $db = new Database();
        $db->CreateConnection();

        $sql = "UPDATE comments SET IsApproved=1 WHERE Id=".$id;

        $success = $db->connection->query($sql);
        $db->CloseConnection();
        return $success;
    }

    public function unapprove($id){
        $db = new Database();
        $db->CreateConnection();

        $sql = "UPDATE comments SET IsApproved=0 WHERE Id=".$id;

        $success = $db->connection->query($sql);
        $db->CloseConnection();
        return $success;
    }

    public function remove($id){
        $db = new Database();
        $db->CreateConnection();

        $sql = "DELETE FROM comments WHERE Id=".$id;

        $success = $db->connection->query($sql);
        $db->CloseConnection();
        return $success;
    }

    public function getById($id){
        $db = new Database();
        $db->CreateConnection();

        $sql = "SELECT * FROM comments WHERE Id=".$id;
        $result = $db->connection->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Comment($row);
        } else {
            return array();
        }
        $db->CloseConnection();
    }
}