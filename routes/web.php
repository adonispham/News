<?php

use Framework\Route;

//Home
Route::get('/', 'HomeController@index');
Route::get('/category/{id}', 'HomeController@getPostsByCategory');
Route::get('/post/{id}', 'HomeController@getPostDetail');
Route::post('/post/{id}/comment', 'PostController@comment');

Route::get('/login', 'HomeController@login', ['LoginMiddleware']);
Route::post('/login', 'HomeController@loginSystem', ['LoginMiddleware']);

Route::get('/register', 'HomeController@register', ['LoginMiddleware']);
Route::post('/register', 'HomeController@registerUser', ['LoginMiddleware']);

Route::get('/admin', 'HomeController@admin', ['AdminMiddleware']);
Route::get('/destroy', 'HomeController@destroy');

// Categories
Route::get('/categories', 'CategoryController@index', ['AdminMiddleware']);
Route::get('/categories/add', 'CategoryController@add', ['AdminMiddleware']);
Route::post('/categories/store', 'CategoryController@store', ['AdminMiddleware']);
Route::get('/categories/edit', 'CategoryController@edit', ['AdminMiddleware']);
Route::post('/categories/update', 'CategoryController@update', ['AdminMiddleware']);
Route::post('/categories/delete', 'CategoryController@delete', ['AdminMiddleware']);

// Posts
Route::get('/posts', 'PostController@index', ['AdminMiddleware']);
Route::get('/posts/add', 'PostController@add', ['AdminMiddleware']);
Route::post('/posts/store', 'PostController@store', ['AdminMiddleware']);
Route::get('/posts/edit', 'PostController@edit', ['AdminMiddleware']);
Route::post('/posts/update', 'PostController@update', ['AdminMiddleware']);
Route::post('/posts/delete', 'PostController@delete', ['AdminMiddleware']);

// User
//Route::get('/users', 'UserController@index', ['AdminMiddleware']);
//Route::post('/users/create', 'UserController@create', ['AdminMiddleware']);
//Route::get('/users/edit/{id}', 'UserController@edit', ['AdminMiddleware']);
//Route::post('/users/update/{id}', 'UserController@update', ['AdminMiddleware']);
//Route::post('/users/delete/{id}', 'UserController@delete', ['AdminMiddleware']);

// API
// For Category API
Route::get('/api/v1/category/{id}/post?page={\d}', 'ApiController@getPostsByCategory');
Route::get('/api/v1/category', 'ApiController@getAllCategory');
Route::get('/api/v1/category/{id}', 'ApiController@getCategory');
Route::post('/api/v1/category', 'ApiController@addCategory');
Route::put('/api/v1/category/{id}', 'ApiController@editCategory');
Route::delete('/api/v1/category/{id}', 'ApiController@deleteCategory');

// For Post API
Route::get('/api/v1/posts?page={\d}&search={.*}', 'ApiController@getAllPost');
Route::get('/api/v1/posts/{id}', 'ApiController@getPost');
Route::post('/api/v1/posts', 'ApiController@addPost');
Route::put('/api/v1/posts/{id}', 'ApiController@editPost');
Route::delete('/api/v1/posts/{id}', 'ApiController@deletePost');

// For User API
Route::get('/api/v1/user/{id}', 'ApiController@getUser');
Route::post('/api/v1/user', 'ApiController@addUser');
Route::put('/api/v1/user/{id}', 'ApiController@editUser');
Route::delete('/api/v1/user/{id}', 'ApiController@deleteUser');

$router = new Route();

try {
    $route = $router->getRoute();
} catch (\Exception $exception) {
    echo $exception->getMessage();
    exit();
}


$route = $router->matchController();