<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'Repositories/CommentRepository.php';
$id = htmlspecialchars($_GET['id']);
$commentRepository = new CommentRepository();
$commentRepository->unapprove($id);
header("Location: /admin.php");