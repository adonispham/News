<?php

namespace Framework\Middlewares;

class AdminMiddleware
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
        if (isset($_SESSION["isAuth"]) && !$_SESSION["isAdmin"]) {
            header('Location: ' . $this->clientPage);
        }

        return $this->next;
    }

}