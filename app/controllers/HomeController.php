<?php

namespace Framework\Controllers;

use Framework\Repositories\CategoryRepository;
use Framework\Repositories\CommentRepository;
use Framework\Repositories\PostRepository;
use Framework\Repositories\UserRepository;

class HomeController extends BaseController
{

    public $clientPage = '/';
    public $adminPage = '/admin';
    public $adminRole = 1;
    public $clientRole = 2;

    public function index()
    {
        return $this->view('home.index');
    }

    public function login()
    {
        return $this->view('general.login');
    }

    public function register()
    {
        return $this->view('general.register');
    }

    public function admin()
    {
        $postRepository = new PostRepository();
        $categoriesRepository = new CategoryRepository();
        return $this->view('admin.index', [
            'categories' => $categoriesRepository->getAllCategories(),
            'posts' => $postRepository->getAllPosts(),
        ]);
    }

    public function loginSystem()
    {
        $login = [
            'username' => $_POST['username'],
            'password' => md5($_POST['password']),
        ];
        if (empty($_POST['username']) || empty($_POST['password'])) {
            return $this->view('general.login', ['error' => "Không được để trống 1 trong 2 trường."]);
        }
        // authentication
        $userRepository = new userRepository();
        $user = $userRepository->getUserByLogin($login);
        if ($user) {
            //set Auth & access system
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['isAuth'] = true;
            $_SESSION['isAdmin'] = $user['permission'] == $this->adminRole ? true : false;
            $this->__setUser($user);
            header('Location: ' . $this->adminPage);
        } else {
            return $this->view('general.login', ['error' => "Tài khoản hoặc mật khẩu không chính xác, vui lòng thử lại."]);
        }
    }

    private function __setUser($user): void
    {
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['permission'] = $user['permission'] ?? 2;
    }

    public function registerUser()
    {
        $userRepository = new userRepository();
        $user = [
            'username' => $_POST['username'],
            'password' => md5($_POST['password']),
        ];
        if (empty($_POST['username']) || empty($_POST['password'])) {
            return $this->view('general.register', ['error' => "Không được để trống 1 trong 2 trường."]);
        }
        //add new user
        if ($userRepository->haveUserInUsers($_POST['username'])) {
            $userRepository->createUser($user);
            //set Auth & access system
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['isAuth'] = true;
            $_SESSION['isAdmin'] = false;
            $this->__setUser($user);
            header('Location: ' . $this->adminPage);
        } else {
            return $this->view('general.register', ['error' => "Username đã tồn tại."]);
        }
    }

    public function destroy()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();
        header('Location: ' . '/login');
    }

    public function getPostsByCategory($categoryId)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $a = $_SESSION['filter']['category'] = $categoryId;
        return $this->view('home.index');
    }

    public function getPostDetail($postId)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['filter']['post'] = $postId;
        $cRepo = new CommentRepository();
        $uRepo = new UserRepository();
        $users = array_column($uRepo->getAllUsers(), 'username', 'id');
        $comments = $cRepo->getAllCommentByPost($postId);
        foreach ($comments as $index => $item) {
            $comments[$index]['username'] = $users[$item['user_id']];
        }

        return $this->view('home.detail', ['comments' => $comments]);
    }
}
