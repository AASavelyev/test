<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once 'Repositories/CommentRepository.php';
    require_once '_headerLayout.php';
    $commentRepository = new CommentRepository();
    $comments = $commentRepository->getApproved();
    $i = 1;
?>
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
<?php
require_once '_bottomLayout.php';
?>