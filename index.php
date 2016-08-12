<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once 'Repositories/CommentRepository.php';
    $commentRepository = new CommentRepository();
    $comments = $commentRepository->getApproved();
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
                    <a href="#" class="navbar-brand">Гостевая книга</a>
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
                            <a href="/comment.php?id=<?= $comment->id?>" class="btn btn-info">Show</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <a href="addcomment.php" class="btn btn-primary">Add your comment!</a>
        </div>

        <script src="scripts/jquery.js"></script>
        <script src="scripts/bootstrap.min.js.js"></script>
    </body>
</html>