<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/application/models/comment.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/application/core/database.php';

class CommentRepository
{
    public function getApproved(){
        $db = new Database();
        $db->CreateConnection();

        $sth = $db->connection->prepare('SELECT * FROM comments WHERE IsApproved=1');
        $sth->execute();
        $result = $sth->fetchAll();
        $comments = array();
        foreach ($result as $row)
        {
            $comments[] = new Comment($row);
        }
        $db->CloseConnection();
        $sth = null;
        return $comments;
    }

    public function getAll(){
        $db = new Database();
        $db->CreateConnection();

        $sth = $db->connection->prepare('SELECT * FROM comments');
        $sth->execute();
        $result = $sth->fetchAll();
        $comments = array();
        foreach ($result as $row)
        {
            $comments[] = new Comment($row);
        }
        $db->CloseConnection();
        $sth = null;
        return $comments;
    }

    public function create(Comment $comment){
        $db = new Database();
        $db->CreateConnection();
        $username = $comment->username;
        $email = $comment->email;
        $site = $comment->site;
        $text = $comment->text;
        $browserInfo = $comment->browserInfo;

        $sth = $db->connection->prepare('INSERT INTO comments (Username, Email, Site, Text, IsApproved, IP, BrowserInfo)
                VALUES (?, ?, ?, ?, 0, ?, ?)');
        $sth->execute(array($username, $email, $site, $text, $comment->ip, $browserInfo));

        $db->CloseConnection();
        $sth = null;
    }

    public function update(Comment $comment){
        $db = new Database();
        $db->CreateConnection();
        $username = $comment->username;
        $email = $comment->email;
        $site = $comment->site;
        $text = $comment->text;

        $sth = $db->connection->prepare('UPDATE comments SET Username=?,Email=?,Site=?,Text=? WHERE Id=?');
        $sth->execute(array($username, $email, $site, $text, $comment->id));

        $db->CloseConnection();
        $sth = null;
    }

    public function approve($id){
        $db = new Database();
        $db->CreateConnection();
        $sth = $db->connection->prepare('UPDATE comments SET IsApproved=1 WHERE Id=?');
        $sth->execute(array($id));
        $db->CloseConnection();
        $sth = null;
    }

    public function unapprove($id){
        $db = new Database();
        $db->CreateConnection();
        $sth = $db->connection->prepare('UPDATE comments SET IsApproved=0 WHERE Id=?');
        $sth->execute(array($id));
        $db->CloseConnection();
        $sth = null;
    }

    public function remove($id){
        $db = new Database();
        $db->CreateConnection();
        $sth = $db->connection->prepare('DELETE FROM comments WHERE Id=?');
        $sth->execute(array($id));
        $db->CloseConnection();
        $sth = null;
    }

    public function getById($id){
        $db = new Database();
        $db->CreateConnection();
        $sth = $db->connection->prepare('SELECT * FROM comments WHERE Id=?');
        $sth->execute(array($id));
        $result = $sth->fetchAll();

        $db->CloseConnection();
        $sth = null;
        if (count($result) > 0) {
            $row = $result[0];
            return new Comment($row);
        } else {
            return array();
        }
    }
}