<?php

class Comment
{
    public $id;
    public $username;
    public $email;
    public $site;
    public $text;
    public $isApproved;
    public $ip;
    public $browserInfo;

    function __construct($data) {
        $this->id = (isset($data['Id'])) ? $data['Id'] : "";
        $this->username = (isset($data['Username'])) ? $data['Username'] : "";
        $this->email = (isset($data['Email'])) ? $data['Email'] : "";
        $this->site = (isset($data['Site'])) ? $data['Site'] : "";
        $this->text = (isset($data['Text'])) ? $data['Text'] : "";
        $this->isApproved = (isset($data['IsApproved'])) ? $data['IsApproved'] : "";
        $this->ip = (isset($data['IP'])) ? $data['IP'] : "";
        $this->browserInfo = (isset($data['BrowserInfo'])) ? $data['BrowserInfo'] : "";
    }
}