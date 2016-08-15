<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../../styles/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../styles/style.css">
    <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit'></script>
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
            <a href="/" class="navbar-brand">Гостевая книга</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-5">
            <p class="navbar-text navbar-right"></p>
        </div>
    </div>
</nav>
<div class="container">
    <?php include 'application/views/'.$content_view; ?>
</div>
<script src="../../scripts/jquery.js"></script>
<script src="../../scripts/bootstrap.min.js"></script>
<script src="../../scripts/addcomment.js"></script>
<script src="../../scripts/admin.js"></script>
<!--<script src="../../scripts/updatecomment.js"></script>-->
</body>
</html>