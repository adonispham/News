<?php

namespace Framework\Controllers;

use Framework\Repositories\CategoryRepository;
use Framework\Repositories\PostRepository;
use Framework\Repositories\UserRepository;

class ApiController extends BaseController
{
    public $cRepo;
    public $pRepo;
    public $uRepo;

    public function __construct()
    {
        $this->cRepo = new CategoryRepository();
        $this->pRepo = new PostRepository();
        $this->uRepo = new UserRepository();
    }

    public function getAllCategory()
    {
        $categories = $this->cRepo->getAllCategories();
        rsort($categories);
        return $this->response($categories, true);
    }

    public function getAllPost()
    {
        $page = $_GET['page'];
        $search = $_GET['search'];
        $total = count($this->pRepo->getAllPosts($search));
        $offset = ($page - 1) * 3;
        $posts = $this->pRepo->getAllPostsPaginate($offset, $search);
        $categories = array_column($this->cRepo->getAllCategories(), 'name', 'id');
        foreach ($posts as $index => $item) {
            $posts[$index]['category_name'] = $categories[$item['category_id']];
        }
        rsort($posts);
        return $this->response([
            'data' => $posts,
            'total' => $total,
        ], true);
    }

    public function getPostsByCategory($categoryId)
    {
        $postRepository = new PostRepository();
        $categoriesRepository = new CategoryRepository();
        $categories = array_column($categoriesRepository->getAllCategories(), 'name', 'id');
        $allPost = $postRepository->getAllPosts();

        $page = $_GET['page'];
        $offset = ($page - 1) * 3;
        $posts = $categoriesRepository->getAllPostByCategory($categoryId, $offset);

        $posts1 = [];
        rsort($allPost);
        rsort($posts);
        foreach ($allPost as $index => $item) {
            if ($item['category_id'] == $categoryId) {
                $allPost[$index]['category_name'] = $categories[$item['category_id']];
                $posts1[] = $allPost[$index];
            }
        }
        foreach ($posts as $index => $item) {
            $posts[$index]['category_name'] = $categories[$item['category_id']];
        }
        return $this->response([
            'data' => $posts,
            'total' => count($posts1),
        ], true);
    }

    // Post API
    public function getPost($id)
    {
        $post = $this->pRepo->editPost($id);
        if ($post) {
            $categoriesRepository = new CategoryRepository();
            $categories = array_column($categoriesRepository->getAllCategories(), 'name', 'id');
            $post['category_name'] = $categories[$post['category_id']];

            return $this->response($post, true);
        }

        return $this->response([], false);
    }

    public function addPost()
    {
        $post = [
            'title' => $_POST['title'],
            'sort_description' => $_POST['sort_description'],
            'category_id' => $_POST['category_id'],
            'content' => $_POST['content'],
            'image_url' => $this->uploadImage($_FILES['image_url']),
        ];
        $postRepository = new PostRepository();
        if ($postRepository->createPost($post)) {
            $_SESSION['success'] = "Tạo mới tin tức thành công.";
            return $this->response([
                'status' => true,
                'message' => "Tạo mới tin tức thành công."
            ], true);
        }
        return $this->response([
            'status' => false,
            'message' => "Xảy ra lỗi trong quá trình tạo mới tin tức. Vui lòng thử lại!"
        ], true);
    }

    private function uploadImage($file)
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

    public function editPost($postId)
    {
        $postRepository = new PostRepository();
        $data = json_decode(file_get_contents("php://input"), true);
        $newPost = [
            'title' => $data['title'],
            'sort_description' => $data['sort_description'],
            'category_id' => $data['category_id'],
            'content' => $data['content'],
        ];
        if ($postRepository->updatePost($newPost, $postId)) {
            return $this->response([
                'status' => true,
                'message' => "Cập nhật tin tức thành công."
            ], true);
        } else {
            return $this->response([
                'status' => false,
                'message' => "Xảy ra lỗi trong quá trình cập nhật tin tức. Vui lòng thử lại!"
            ], true);
        }
    }

    public function deletePost($postId)
    {
        $postRepository = new PostRepository();
        if ($postRepository->deletePost($postId)) {
            return $this->response([
                'status' => true,
                'message' => "Xoá tin tức thành công."
            ], true);
        } else {
            return $this->response([
                'status' => false,
                'message' => "Xảy ra lỗi trong quá trình xoá tin tức. Vui lòng thử lại!"
            ], true);
        }
    }

    // Category API
    public function getCategory($id)
    {
        $categoriesRepository = new CategoryRepository();
        $category = $categoriesRepository->editCategory($id);
        if ($category) {
            return $this->response([
                'status' => true,
                'data' => $category
            ], true);
        }
        return $this->response([
            'status' => false,
            'data' => []
        ], true);
    }

    public function addCategory()
    {
        $category = [
            'name' => $_POST['title'],
            'description' => $_POST['description'],
        ];

        $categoriesRepository = new CategoryRepository();
        if ($categoriesRepository->createCategory($category)) {
            return $this->response([
                'status' => true,
                'message' => "Tạo mới chuyên mục tin tức thành công."
            ], true);
        }

        return $this->response([
            'status' => false,
            'message' => "Xảy ra lỗi trong quá trình tạo mới chuyên mục. Vui lòng thử lại!"
        ], true);
    }

    public function editCategory($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $categoriesRepository = new CategoryRepository();
        $newCategory = [
            'name' => $data['title'],
            'description' => $data['description'],
        ];
        if ($categoriesRepository->updateCategory($newCategory, $id)) {
            return $this->response([
                'status' => true,
                'message' => "Cập nhật chuyên mục tin tức thành công."
            ], true);
        }
        return $this->response([
            'status' => false,
            'message' => "Xảy ra lỗi trong quá trình cập nhật chuyên mục. Vui lòng thử lại!"
        ], true);
    }

    public function deleteCategory($id)
    {
        // todo - check exist post in category before delete
        $postRepository = new PostRepository();
        if ($postRepository->havePostInCategory($id)) {
            return $this->response([
                'status' => true,
                'message' => "Chuyên mục đang lưu trữ tin tức. Không thể xoá!"
            ], true);
        }
        $categoriesRepository = new CategoryRepository();
        if ($categoriesRepository->deleteCategory($id)) {
            return $this->response([
                'status' => true,
                'message' => "Xoá chuyên mục tin tức thành công."
            ], true);
        } else {
            return $this->response([
                'status' => false,
                'message' => "Xảy ra lỗi trong quá trình xoá chuyên mục. Vui lòng thử lại!"
            ], true);
        }
    }

    // User API
    public function getUser($id)
    {
        $user = $this->uRepo->editUser($id);
        if ($user) {
            return $this->response([
                'status' => true,
                'data' => $user
            ], true);
        }
        return $this->response([
            'status' => false,
            'data' => []
        ], true);
    }

    public function addUser()
    {
        $user = [
            'username' => $_POST['username'],
            'password' => md5($_POST['password']),
        ];

        if ($this->uRepo->createUser($user)) {
            return $this->response([
                'status' => true,
                'message' => "Tạo mới người dùng thành công."
            ], true);
        }

        return $this->response([
            'status' => false,
            'message' => "Xảy ra lỗi trong quá trình tạo mới người dùng. Vui lòng thử lại!"
        ], true);
    }

    public function editUser($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $newUser = [
            'username' => $data['username'],
            'password' => md5($data['password']),
        ];

        if ($this->uRepo->updateUser($newUser, $id)) {
            return $this->response([
                'status' => true,
                'message' => "Cập nhật thông tin người dùng thành công."
            ], true);
        }
        return $this->response([
            'status' => false,
            'message' => "Xảy ra lỗi trong quá trình cập nhật thông tin người dùng. Vui lòng thử lại!"
        ], true);
    }

    public function deleteUser($id)
    {
        if ($this->uRepo->deleteUser($id)) {
            return $this->response([
                'status' => true,
                'message' => "Xoá người dùng hệ thống thành công."
            ], true);
        } else {
            return $this->response([
                'status' => false,
                'message' => "Xảy ra lỗi trong quá trình xoá người dùng hệ thống. Vui lòng thử lại!"
            ], true);
        }
    }
}
