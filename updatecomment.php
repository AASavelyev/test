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
            <a href="index.php" class="navbar-brand">Гостевая книга</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-5">
            <p class="navbar-text navbar-right"></p>
        </div>
    </div>
</nav>
<div class="container">
    <h3 class="text-center">Add your comment</h3>
    <form class="form-horizontal" action="savecomment.php" method="post">
        <input type="hidden" name="id" value="<?= $comment->id ?>">
        <div class="form-group">
            <label for="inputUserName" class="col-sm-2 control-label">User Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="username" id="inputUserName" placeholder="User Name" value="<?= $comment->username ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email" value="<?= $comment->email ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputSite" class="col-sm-2 control-label">Site</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="site" id="inputSite" placeholder="Site" value="<?= $comment->site ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputText" class="col-sm-2 control-label">Text</label>
            <div class="col-sm-10">
                <textarea placeholder="Text" class="form-control" name="comment" id="inputText" rows="5"><?= $comment->text ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Save</button>
            </div>
        </div>
    </form>
</div>

<script src="scripts/jquery.js"></script>
<script src="scripts/bootstrap.min.js"></script>
</body>
</html>

