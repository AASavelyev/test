<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once 'Repositories/CommentRepository.php';
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    if ($username !== 'admin' || $password !== '123456')
    {
        header("Location: /adminlogin.php");
    }

    $commentRepository = new CommentRepository();
    $comments = $commentRepository->getAll();
    $i = 1;
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
    <table class="table">
        <caption>All comments</caption>
        <thead>
        <tr>
            <th>#</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Site</th>
            <th>Text</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($comments as $comment): ?>
            <tr>
                <th scope="row"><?= $i++ ?></th>
                <td><?= $comment->username ?></td>
                <td><?= $comment->email ?></td>
                <td><?= $comment->site ?></td>
                <td><?= $comment->text ?></td>
                <td>
                    <?php if ($comment->isApproved): ?>
                        <a href="/unapproveComment.php?id=<?= $comment->id?>" class="btn btn-danger">Unapprove</a>
                    <?php else: ?>
                        <a href="/approveComment.php?id=<?= $comment->id?>" class="btn btn-info">Approve</a>
                    <?php endif; ?>

                </td>
                <td>
                    <button name="show-remove-modal-btn" class="btn btn-danger" data-id="<?= $comment->id?>">Remove</button>
                </td>
                <td>
                    <a href="/updatecomment.php?id=<?= $comment->id?>" class="btn btn-primary">Change</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<input type="hidden" id="removed-comment">
<div class="modal fade" tabindex="-1" role="dialog" id="remove-comment-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Are you really want to remove this comment?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="remove-comment-btn">OK</button>
            </div>
        </div>
    </div>
</div>

<script src="scripts/jquery.js"></script>
<script src="scripts/bootstrap.min.js"></script>
<script src="scripts/admin.js"></script>
</body>
</html>