<?php

class Validation
{
    public function validateEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function validateUrl($url){
        return $url === "" || filter_var($url, FILTER_VALIDATE_URL);
    }

    public function checkXSS($str){
        if ($str != html_entity_decode(strip_tags($str))){
            return true;
        }
        return false;
    }
}