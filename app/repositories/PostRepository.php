<?php

namespace Framework\Repositories;

use Framework\Models\Post;

class PostRepository implements PostRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Post();
    }

    /**
     * getAll
     * @return mixed
     */
    public function getAllPosts($search = "")
    {
        return $this->model->getAllPost($search);
    }

    /**
     * getAll
     * @return mixed
     */
    public function getAllPostsPaginate($offset, $search)
    {
        return $this->model->getAllWithPaginate($offset, $search);
    }

    /**
     * create
     * @param array $attributes
     * @return mixed
     */
    public function createPost($attributes = [])
    {
        return $this->model->save($attributes);
    }

    /**
     * edit
     * @param $id
     * @return mixed
     */
    public function editPost($id)
    {
        return $this->model->findById($id);
    }

    /**
     * edit
     * @param $id
     * @return mixed
     */
    public function havePostInCategory($categoryId)
    {
        return $this->model->havePostInCategory($categoryId);
    }

    /**
     * update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function updatePost($attributes, $id)
    {
        return $this->model->update($attributes, $id);
    }

    /**
     * delete
     * @param $id
     * @return mixed
     */
    public function deletePost($id)
    {
        return $this->model->destroy($id);
    }
}