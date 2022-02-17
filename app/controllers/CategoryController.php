<?php

namespace Framework\Controllers;

use Framework\Repositories\CategoryRepository;
use Framework\Repositories\PostRepository;

class CategoryController extends BaseController
{

    public $clientPage = '/';
    public $adminPage = '/admin';
    public $adminRole = 1;
    public $clientRole = 2;

    public function index()
    {
        $categoriesRepository = new CategoryRepository();
        return $this->view('categories.index', ['categories' => $categoriesRepository->getAllCategories()]);
    }

    public function edit()
    {
        $categoriesRepository = new CategoryRepository();
        $category = $categoriesRepository->editCategory($_GET['id']);
        if (!isset($_SESSION)) {
            session_start();
        }
        if ($category) {
            return $this->view('categories.edit', ['category' => $category]);
        } else {
            $_SESSION['error'] = "Chuyên mục không tồn tại. Vui lòng thử lại";
            return header('Location: ' . "/categories");
        }
    }

    public function update()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $categoriesRepository = new CategoryRepository();
        $newCategory = [
            'name' => $_POST['title'],
            'description' => $_POST['description'],
        ];
        if ($categoriesRepository->updateCategory($newCategory, $_POST['id'])) {
            $_SESSION['success'] = "Cập nhật chuyên mục tin tức thành công.";
        } else {
            $_SESSION['error'] = "Xảy ra lỗi trong quá trình cập nhật chuyên mục. Vui lòng thử lại!";
        }
        return header('Location: ' . "/categories/edit?id={$_POST['id']}");
    }

    public function add()
    {
        return $this->view('categories.add');
    }

    public function store()
    {
        $category = [
            'name' => $_POST['title'],
            'description' => $_POST['description'],
        ];
        if (!isset($_SESSION)) {
            session_start();
        }
        if (empty(trim($_POST['title'])) || empty(trim($_POST['description']))) {
            $_SESSION['error'] = "Các trường không được để trống. Vui lòng thử lại!";
            return header('Location: ' . "/categories/add");
        }
        $categoriesRepository = new CategoryRepository();
        if ($categoriesRepository->createCategory($category)) {
            $_SESSION['success'] = "Tạo mới chuyên mục tin tức thành công.";
            return header('Location: ' . "/categories");
        }
        $_SESSION['error'] = "Xảy ra lỗi trong quá trình tạo mới chuyên mục. Vui lòng thử lại!";
        return header('Location: ' . "/categories/add");
    }

    public function delete()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        // todo - check exist post in category before delete
        $postRepository = new PostRepository();
        if ($postRepository->havePostInCategory($_POST['id'])) {
            $_SESSION['error'] = "Chuyên mục đang lưu trữ tin tức. Không thể xoá!";
            return header('Location: ' . "/categories");
        }
        $categoriesRepository = new CategoryRepository();
        if ($categoriesRepository->deleteCategory($_POST['id'])) {
            $_SESSION['success'] = "Xoá chuyên mục tin tức thành công.";
        } else {
            $_SESSION['error'] = "Xảy ra lỗi trong quá trình xoá chuyên mục. Vui lòng thử lại!";
        }
        return header('Location: ' . "/categories");
    }
}