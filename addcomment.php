<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '_headerLayout.php'
?>

<div class="container">
    <h3 class="text-center">Add your comment</h3>
    <h3 class="text-success hide text-center"></h3>
    <h3 class="text-danger hide text-center"></h3>
    <form class="form-horizontal" action="savecomment.php" method="post">
        <input type="hidden" name="id" value="0">
        <div class="form-group">
            <label for="inputUserName" class="col-sm-2 control-label">User Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="username" id="inputUserName" placeholder="User Name">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email">
            </div>
        </div>
        <div class="form-group">
            <label for="inputSite" class="col-sm-2 control-label">Site</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="site" id="inputSite" placeholder="Site">
            </div>
        </div>
        <div class="form-group">
            <label for="inputText" class="col-sm-2 control-label">Text</label>
            <div class="col-sm-10">
                <textarea placeholder="Text" class="form-control" name="comment" id="inputText" rows="5"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div id="g-recaptcha" class="g-recaptcha col-sm-10 col-sm-offset-2"></div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default" name="submit-btn" disabled>Comment</button>
            </div>
        </div>
    </form>
</div>

<script src="scripts/jquery.js"></script>
<script src="scripts/bootstrap.min.js"></script>
<script src="scripts/addcomment.js"></script>
<?php
    require_once '_bottomLayout.php'
?>
