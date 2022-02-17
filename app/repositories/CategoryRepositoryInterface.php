<?php

namespace Framework\Repositories;

interface CategoryRepositoryInterface
{

    public function getAllCategories();

    public function getAllPostByCategory($categoryId, $offset);

    public function createCategory($attributes = []);

    public function editCategory($id);

    public function updateCategory($attributes, $id);

    public function deleteCategory($id);

}