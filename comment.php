<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once 'Repositories/CommentRepository.php';
    $id = htmlspecialchars($_GET['id']);
    $commentRepository = new CommentRepository();
    $comment = $commentRepository->getById($id);
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
            <a href="#" class="navbar-brand">Гостевая книга</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-5">
            <p class="navbar-text navbar-right"></p>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <h3>Username:</h3>
        </div>
        <div class="col-md-10">
            <h3><?= $comment->username ?></h3>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-2">
            <h3>Email:</h3>
        </div>
        <div class="col-md-10">
            <h3><?= $comment->email ?></h3>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-2">
            <h3>Site:</h3>
        </div>
        <div class="col-md-10">
            <h3><?= $comment->site ?></h3>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-2">
            <h3>Comment:</h3>
        </div>
        <div class="col-md-10">
            <h3><?= $comment->text ?></h3>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<script src="scripts/jquery.js"></script>
<script src="scripts/bootstrap.min.js.js"></script>
</body>
</html>
