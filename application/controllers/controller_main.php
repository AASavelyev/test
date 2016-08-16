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

        $errors = $this->validate($username, $email, $site, $comment);
        $comment = array(
            'Id' => $commentId,
            'Username' => $username,
            'Email' => $email,
            'Site' => $site,
            'Text' => $comment,
            'IP' => $_SERVER['REMOTE_ADDR'],
            'BrowserInfo' => $_SERVER['HTTP_USER_AGENT']
        );

        if ($this->adminRepository->isAuth() && $commentId != 0) { // it means that this request sent admin
            if (count($errors) == 0 ){
                $this->commentRepository->update(new Comment($comment));
            }
        }
        else {
            $token = htmlspecialchars($_POST['g-recaptcha-response']);
            if (!$this->check_token($token)){
                $errors[] = 'Captcha is not valid or timeout.';
            }
            if (count($errors) == 0) {
                $this->commentRepository->create(new Comment($comment));;
            }
        }
        $result = array(
            'success' => count($errors) == 0,
            'errors' => $errors
        );
        echo json_encode($result);
    }

    private function validate($username, $email, $site, $comment)
    {
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
        return $errors;
    }

    private function check_token($token)
    {
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
        return $result['success'];
    }
}