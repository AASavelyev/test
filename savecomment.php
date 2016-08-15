<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once 'Repositories/CommentRepository.php';
    require_once 'Repositories/AdminRepository.php';
    require_once 'Validation/Validation.php';
    $commentRepository = new CommentRepository();
    $adminRepository = new AdminRepository();

    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $site = htmlspecialchars($_POST['site']);
    $comment = htmlspecialchars($_POST['comment']);
    $id = htmlspecialchars($_POST['id']);

    $errors = array();
    $validation = new Validation();
    if ($username == ''){
        $errors[] = 'Username is required.';
    }
    if ($validation->checkXSS($username)){
        $errors[] = 'Not valid. Please don\'t use HTML.' ;
    }
    if (!$validation->validateEmail($email)){
        $errors[] = 'Please use valid email.' ;
    }
    if (!$validation->validateUrl($site)){
        $errors[] = 'Please use valid url.' ;
    }
    if ($comment == ''){
        $errors[] = 'Comment is required' ;
    }
    if ($validation->checkXSS($comment)){
        $errors[] = 'Not valid. Please don\'t use HTML.' ;
    }

    if ($adminRepository->isAuth() && $id != 0) { // it means that this request sent admin
        if (count($errors) == 0 ){
            $commentRepository->update(new Comment(array(
                'Id' => $id,
                'Username' => $username,
                'Email' => $email,
                'Site' => $site,
                'Text' => $comment
            )));
            $result = array(
                'success' => true
            );
            echo json_encode($result);
        }
        else {
            $result = array(
                'success' => false,
                'errors' => $errors
            );
            echo json_encode($result);
        }
    }
    else {
        $token = htmlspecialchars($_POST['g-recaptcha-response']);

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => '6LfAkCcTAAAAAB9AKmYLhZ7aVUoLRa8Q8H0LwMMC',
            'response' => $token
        );

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = json_decode(file_get_contents($url, false, $context), true);
        if (!$result['success']){
            $errors[] = 'Captcha is not valid or timeout.';
        }

        if (count($errors) == 0) {
            $commentRepository->create(new Comment(array(
                'Username' => $username,
                'Email' => $email,
                'Site' => $site,
                'Text' => $comment,
                'IP' => $_SERVER['REMOTE_ADDR'],
                'BrowserInfo' => $_SERVER['HTTP_USER_AGENT']
            )));
            $result = array(
                'success' => true
            );
            echo json_encode($result);
        }
        else {
            $result = array(
                'success' => false,
                'errors' => $errors
            );
            echo json_encode($result);
        }
    }