<?php

namespace Framework\Repositories;

use Framework\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function __construct()
    {
        $this->model = new Category();
    }

    /**
     * getAll
     * @return mixed
     */
    public function getAllCategories()
    {
        return $this->model->getAll();
    }

    public function getAllPostByCategory($categoryId, $offset)
    {
        return $this->model->getAllPostByCategoryAndPaginate($categoryId, $offset);
    }

    /**
     * create
     * @param array $attributes
     * @return mixed
     */
    public function createCategory($attributes = [])
    {
        return $this->model->save($attributes);
    }

    /**
     * edit
     * @param $id
     * @return mixed
     */
    public function editCategory($id)
    {
        return $this->model->findById($id);
    }

    /**
     * edit
     * @param $id
     * @return mixed
     */
    public function getCategoryByLogin($login)
    {
        return $this->model->findByLogin($login);
    }

    /**
     * update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function updateCategory($attributes, $id)
    {
        return $this->model->update($attributes, $id);
    }

    /**
     * delete
     * @param $id
     * @return mixed
     */
    public function deleteCategory($id)
    {
        return $this->model->destroy($id);
    }
}