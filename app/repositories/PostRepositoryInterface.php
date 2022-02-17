<?php

namespace Framework\Repositories;

interface PostRepositoryInterface
{

    public function getAllPosts($search = "");

    public function getAllPostsPaginate($offset, $search);

    public function createPost($attributes = []);

    public function editPost($id);

    public function updatePost($attributes, $id);

    public function deletePost($id);

    public function havePostInCategory($categoryId);
}