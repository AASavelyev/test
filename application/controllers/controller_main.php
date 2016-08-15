<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/application/models/comment.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/application/repositories/commentRepository.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/application/repositories/adminRepository.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/application/core/controller.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/application/validation/validation.php';
class Controller_Main extends Controller
{
    private $adminRepository;
    private $commentRepository;

    public function __construct()
    {
        $this->adminRepository = new AdminRepository();
        $this->commentRepository = new CommentRepository();
        $this->view = new View();
    }

    function action_index()
    {
        $data = $this->commentRepository->getApproved();
        $this->view->generate('main/main_view.php', 'template_view.php', $data);
    }

    function action_add()
    {
        $this->view->generate('main/add_view.php', 'template_view.php');
    }

    function action_show($id)
    {
        $commentRepository = new CommentRepository();
        $comment = $commentRepository->getById($id);
        $this->view->generate('main/comment_view.php', 'template_view.php', $comment);
    }

    function action_save()
    {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $site = htmlspecialchars($_POST['site']);
        $comment = htmlspecialchars($_POST['comment']);
        $commentId = htmlspecialchars($_POST['id']);

        $errors = array();
        $validation = new Validation();
        if ($username == ''){
            $errors[] = 'Username is required.';
        }
        if ($validation->checkXSS($username)){
            $errors[] = 'Not valid. Please don\'t use HTML.' ;
        }
        if (!$validation->validateEmail($email)){
            $errors[] = 'Please use valid email.' ;
        }
        if (!$validation->validateUrl($site)){
            $errors[] = 'Please use valid url.' ;
        }
        if ($comment == ''){
            $errors[] = 'Comment is required' ;
        }
        if ($validation->checkXSS($comment)){
            $errors[] = 'Not valid. Please don\'t use HTML.' ;
        }

        if ($this->adminRepository->isAuth() && $commentId != 0) { // it means that this request sent admin
            if (count($errors) == 0 ){
                $this->commentRepository->update(new Comment(array(
                    'Id' => $commentId,
                    'Username' => $username,
                    'Email' => $email,
                    'Site' => $site,
                    'Text' => $comment
                )));
                $result = array(
                    'success' => true
                );
                echo json_encode($result);
            }
            else {
                $result = array(
                    'success' => false,
                    'errors' => $errors
                );
                echo json_encode($result);
            }
        }
        else {
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
            if (!$result['success']){
                $errors[] = 'Captcha is not valid or timeout.';
            }

            if (count($errors) == 0) {
                $this->commentRepository->create(new Comment(array(
                    'Username' => $username,
                    'Email' => $email,
                    'Site' => $site,
                    'Text' => $comment,
                    'IP' => $_SERVER['REMOTE_ADDR'],
                    'BrowserInfo' => $_SERVER['HTTP_USER_AGENT']
                )));
                $result = array(
                    'success' => true
                );
                echo json_encode($result);
            }
            else {
                $result = array(
                    'success' => false,
                    'errors' => $errors
                );
                echo json_encode($result);
            }
        }
    }
}