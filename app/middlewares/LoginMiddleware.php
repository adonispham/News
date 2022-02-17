<?php

namespace Framework\Middlewares;

class LoginMiddleware
{

    public $next = true;
    public $clientPage = '/';
    public $adminPage = '/admin';

    public function action($router, $method, $params)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION["isAuth"])) {
            if ($_SESSION["isAdmin"]) {
                header('Location: ' . $this->adminPage);
            }
            header('Location: ' . $this->clientPage);
        }
        return $this->next;
    }

}