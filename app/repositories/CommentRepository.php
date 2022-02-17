<?php

namespace Framework\Repositories;

use Framework\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Comment();
    }

    /**
     * getAll
     * @return mixed
     */
    public function getAllCommentByPost($postId)
    {
        return $this->model->getCommentByPost($postId);
    }

    /**
     * create
     * @param array $attributes
     * @return mixed
     */
    public function createComment($attributes = [])
    {
        return $this->model->save($attributes);
    }

    // /**
    //  * edit
    //  * @param $id
    //  * @return mixed
    //  */
    // public function editPost($id)
    // {
    //     return $this->model->findById($id);
    // }

    // /**
    //  * edit
    //  * @param $id
    //  * @return mixed
    //  */
    // public function havePostInCategory($categoryId)
    // {
    //     return $this->model->havePostInCategory($categoryId);
    // }

    // /**
    //  * update
    //  * @param $id
    //  * @param array $attributes
    //  * @return mixed
    //  */
    // public function updatePost($attributes, $id)
    // {
    //     return $this->model->update($attributes, $id);
    // }

    // /**
    //  * delete
    //  * @param $id
    //  * @return mixed
    //  */
    // public function deletePost($id)
    // {
    //     return $this->model->destroy($id);
    // }
}