<?php

namespace Framework;

use Framework\Exceptions\MiddlewareException;

class Route
{
    /**
     * @param $pattern
     * @param string $dest
     * Note:
     *
     */
    private static $routeTable = [];
    // Xác định route hiện tại
    public $currentRoute = null;

    public static function get($path, $ctlAction, $classMiddle = [])
    {
        $method = RouterMethod::GET;
        $pattern = $path;
        $dest = explode("@", $ctlAction);
        $middleware = $classMiddle;
        self::setRouteTable($method, $pattern, $dest, $middleware);
    }

    public static function setRouteTable($method, $pattern, $dest = [], $middleware = [])
    {
        self::$routeTable[$method][$pattern] = [
            'controller' => $dest[0],
            'action' => $dest[1] ?? 'index',
            'middleware' => $middleware,
        ];
    }

    public static function post($path, $ctlAction, $classMiddle = [])
    {
        $method = RouterMethod::POST;
        $pattern = $path;
        $dest = explode("@", $ctlAction);
        $middleware = $classMiddle;
        self::setRouteTable($method, $pattern, $dest, $middleware);
    }

    public static function put($path, $ctlAction, $classMiddle = [])
    {
        $method = RouterMethod::PUT;
        $pattern = $path;
        $dest = explode("@", $ctlAction);
        $middleware = $classMiddle;
        self::setRouteTable($method, $pattern, $dest, $middleware);
    }

    public static function delete($path, $ctlAction, $classMiddle = [])
    {
        $method = RouterMethod::DELETE;
        $pattern = $path;
        $dest = explode("@", $ctlAction);
        $middleware = $classMiddle;
        self::setRouteTable($method, $pattern, $dest, $middleware);
    }

    //Match current URL router table and set current route

    public function matchController()
    {
        $current = $this->getRoute();
        $convertController = "Framework\\Controllers\\" . $current['controller'] . "";
        $controller = new $convertController;
        $action = $current['action'];
        call_user_func_array([$controller, $action], $current['param']);
    }

    public function getRoute()
    {
        $this->matching();
        return $this->currentRoute;
    }

    private function matching()
    {
        //parse_url: split url & querystring to array
        $url = parse_url($_SERVER['REQUEST_URI']);
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $url['path'];
        $routeTables = self::$routeTable[$method];
        $patternScore = [];

        //Check $path === $this->routeTable
        foreach ($routeTables as $pattern => $value) {
            $patternScore[] = $this->patternScore($path, $pattern);
        }

        usort($patternScore, function ($a, $b) {
            if ($a['score'] === $b['score']) {
                if ($a['param'] == "" && $b['param'] == "") {
                    $a['param'] = $b['param'] = "";
                } else {
                    return count($a['param']) < count($b['param']);
                }
            }
            return $a['score'] < $b['score'];
        });

        if ($patternScore[0]['score'] == 0) {
            http_response_code(404);
            exit();
        }

        $this->currentRoute = self::$routeTable[$method][$patternScore[0]['pattern']];
        $this->currentRoute['param'] = $patternScore[0]['param'];
        if (count($this->currentRoute['middleware'])) {
            foreach ($this->currentRoute['middleware'] as $middleware) {
                $fullPath = 'Framework\Middlewares\\' . $middleware;
                $objMiddle = new $fullPath;
                $objMiddle->action($this->currentRoute, $method, $this->currentRoute['param']);
                if ($objMiddle->next == false) {
                    $message = "Request không hợp lệ";
                    throw new MiddlewareException($message);
                }
            }
        }
        //Output: currentRoute = ['controller' => '', 'action' => '', 'params' => ['id' => '...']];
    }

    private function patternScore($path, $pattern)
    {
        $path = explode('/', $path);

        $exPattern = explode('/', $pattern);

        if (count($path) != count($exPattern)) {
            return ['score' => 0, 'param' => '', 'pattern' => $pattern];
        }
        $score = 0;
        $param = [];

        foreach ($exPattern as $key => $value) {
            if ($path[$key] == $value) {
                $score += 1;
            } else {
                $convertP = $this->convertParam($value);
                if ($convertP) {
                    $param[$convertP] = $path[$key];
                }
            }
        }

        return ['score' => $score, 'param' => $param, 'pattern' => $pattern];
    }

    private function convertParam($value)
    {
        $start = substr($value, 0, 1);
        $end = substr($value, -1, 1);

        if ($start == "{" && $end == "}") {
            return str_replace(['{', '}'], '', $value);
        }
        return '';
    }
}
