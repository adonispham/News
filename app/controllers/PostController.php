<?php

namespace Framework\Controllers;

use Framework\Repositories\CategoryRepository;
use Framework\Repositories\CommentRepository;
use Framework\Repositories\PostRepository;

class PostController extends BaseController
{

    public function index()
    {
        $postsRepository = new PostRepository();
        $categoryRepository = new CategoryRepository();
        $posts = $postsRepository->getAllPosts();
        $categories = $categoryRepository->getAllCategories();
        $categoriesArray = array_column($categories, 'name', 'id');

        return $this->view('posts.index', ['posts' => $posts, 'categories' => $categoriesArray]);
    }

    public function edit()
    {
        $postRepository = new PostRepository();
        $categoryRepository = new CategoryRepository();
        $post = $postRepository->editPost($_GET['id']);
        $categories = $categoryRepository->getAllCategories();
        if (!isset($_SESSION)) {
            session_start();
        }
        if ($post) {
            return $this->view('posts.edit', ['categories' => $categories, 'post' => $post]);
        } else {
            $_SESSION['error'] = "Tin tức không tồn tại. Vui lòng thử lại";
            return header('Location: ' . "/posts");
        }
    }

    public function update()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $postRepository = new PostRepository();
        $newPost = [
            'title' => $_POST['title'],
            'sort_description' => $_POST['sort_description'],
            'category_id' => $_POST['category_id'],
            'content' => $_POST['content'],
        ];
        if ($postRepository->updatePost($newPost, $_POST['id'])) {
            $_SESSION['success'] = "Cập nhật tin tức thành công.";
        } else {
            $_SESSION['error'] = "Xảy ra lỗi trong quá trình cập nhật tin tức. Vui lòng thử lại!";
        }
        return header('Location: ' . "/posts/edit?id={$_POST['id']}");
    }

    public function add()
    {
        $categoryRepository = new CategoryRepository();
        return $this->view('posts.add', ['categories' => $categoryRepository->getAllCategories()]);
    }

    public function store()
    {
        $post = [
            'title' => $_POST['title'],
            'sort_description' => $_POST['sort_description'],
            'category_id' => $_POST['category_id'],
            'content' => $_POST['content'],
            'image_url' => $this->__uploadImage($_FILES['image_url']),
        ];
        if (!isset($_SESSION)) {
            session_start();
        }
        if (empty(trim($_POST['title'])) || empty(trim($_POST['sort_description']))
            || empty(trim($_POST['content'])) || empty(trim($_POST['category_id']))) {
            $_SESSION['error'] = "Các trường không được để trống. Vui lòng thử lại!";
            return header('Location: ' . "/posts/add");
        }
        $postRepository = new PostRepository();
        if ($postRepository->createPost($post)) {
            $_SESSION['success'] = "Tạo mới tin tức thành công.";
            return header('Location: ' . "/posts");
        }
        $_SESSION['error'] = "Xảy ra lỗi trong quá trình tạo mới tin tức. Vui lòng thử lại!";
        return header('Location: ' . "/posts/add");
    }

    private function __uploadImage($file)
    {
        if (isset($file)) {
            $target_dir = "uploads/";
            $target_file = $target_dir . strtotime(date('Y-m-d H:i:s')) . "-" . basename($file["name"]);
            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                return $target_file;
            }
        }
        return null;
    }

    public function delete()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $postRepository = new PostRepository();
        if ($postRepository->deletePost($_POST['id'])) {
            $_SESSION['success'] = "Xoá tin tức thành công.";
        } else {
            $_SESSION['error'] = "Xảy ra lỗi trong quá trình xoá tin tức. Vui lòng thử lại!";
        }
        return header('Location: ' . "/posts");
    }

    public function comment($postId)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            return header('Location: ' . "/login");
        } else {
            $comment = [
                'user_id' => $_SESSION['user_id'],
                'post_id' => $postId,
                'comment' => $_POST['comment']
            ];
            $cRepo = new CommentRepository();
            $cRepo->createComment($comment);
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['filter']['post'] = $postId;
            return header('Location: ' . "/post/{$postId}");
        }
    }
}