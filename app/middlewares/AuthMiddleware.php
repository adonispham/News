<?php

namespace Framework\Middlewares;

class AuthMiddleware
{

    public $next = true;
    public $defaultPage = '/login';
    public $clientPage = '/';
    public $adminPage = '/admin';

    public function action($router, $method, $params)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION["isAuth"])) {
            header('Location: ' . $this->clientPage);
        }

        return $this->next;
    }

}