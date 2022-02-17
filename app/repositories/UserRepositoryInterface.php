<?php

namespace Framework\Repositories;

interface UserRepositoryInterface
{

    public function getAllUsers();

    public function createUser($attributes = []);

    public function editUser($id);

    public function getUserByLogin($login);

    public function updateUser($attributes, $id);

    public function deleteUser($id);

    public function haveUserInUsers($username);

}
