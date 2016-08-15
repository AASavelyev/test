<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/application/models/comment.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/application/repositories/commentRepository.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/application/repositories/adminRepository.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/application/core/controller.php';
class Controller_Admin extends Controller
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
        $username = array_key_exists('username', $_POST) ? htmlspecialchars($_POST['username']) : "";
        $password = array_key_exists('password', $_POST) ? htmlspecialchars($_POST['password']) : "";
        if ($this->adminRepository->isAuth() || $this->adminRepository->login($username, $password)){
            $data = $this->commentRepository->getAll();
            $this->view->generate('admin/admin_view.php', 'template_view.php', $data);
        }
        else {
            header("Location: /admin/login");
            $this->action_login();
        }
    }

    function action_login()
    {
        $this->view->generate('admin/login_view.php', 'template_view.php');
    }

    function action_approve($id)
    {
        $this->commentRepository->approve($id);
        header("Location: /admin");
        $this->action_index();
    }

    function action_unapprove($id)
    {
        $this->commentRepository->unapprove($id);
        header("Location: /admin");
        $this->action_index();
    }

    function action_remove($id)
    {
        $this->commentRepository->remove($id);
        header("Location: /admin");
        $this->action_index();
    }

    function action_update($id){
        $comment = $this->commentRepository->getById($id);
        $this->view->generate('admin/update_view.php', 'template_view.php', $comment);
    }
}