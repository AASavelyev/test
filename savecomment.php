<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once 'Repositories/CommentRepository.php';
    require_once 'Validation/Validation.php';
    $commentRepository = new CommentRepository();

    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $site = htmlspecialchars($_POST['site']);
    $comment = htmlspecialchars($_POST['comment']);
    $id = htmlspecialchars($_POST['id']);
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

    $validation = new Validation();
    $isValid = $username != '' && !$validation->checkXSS($username)
                && $validation->validateEmail($email)
                && $validation->validateUrl($site)
                && $comment != '' && !$validation->checkXSS($comment)
                && $result['success'];
    if ($isValid){
        if ($id == 0) {
            $commentRepository->create(new Comment(array(
                'Username' => $username,
                'Email' => $email,
                'Site' => $site,
                'Text' => $comment,
                'IP' => $_SERVER['REMOTE_ADDR'],
                'BrowserInfo' => $_SERVER['HTTP_USER_AGENT']
            )));
        }
        else {
            $commentRepository->update(new Comment(array(
                'Id' => $id,
                'Username' => $username,
                'Email' => $email,
                'Site' => $site,
                'Text' => $comment
            )));
            header("Location: /admin.php");
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="collapsed navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-5" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand">Гостевая книга</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-5">
            <p class="navbar-text navbar-right"></p>
        </div>
    </div>
</nav>
<div class="container">
    <?php if ($isValid): ?>
        <h2>Your comment was added to moderation.</h2>
    <?php else: ?>
        <h2>Probably you missed something please check again. Username, email and comment are required.</h2>
    <?php endif; ?>
</div>

<script src="scripts/jquery.js"></script>
<script src="scripts/bootstrap.min.js.js"></script>
</body>
</html>
