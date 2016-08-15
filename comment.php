<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once 'Repositories/CommentRepository.php';
    require_once '_headerLayout.php';
    $id = htmlspecialchars($_GET['id']);
    $commentRepository = new CommentRepository();
    $comment = $commentRepository->getById($id);

?>

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
<?php
require_once '_bottomLayout.php';
?>
