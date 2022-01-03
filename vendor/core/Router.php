<?php


namespace vendor\core;

use vendor\core\ErrorHandler;
use vendor\core\base;


class Router
{
    /**
     *  List routes
     */
    protected static $routes = [];

    /**
     * Current route
     */
    protected static $route = [];

    /**
     * Added route to list routers
     * @param $regexp - route regex
     * @param array $route - route
     */
    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    /**
     * Return list routes
     * @return array
     */
    public static function getRoutes()
    {
        return self::$routes;
    }

    /**
     * Return the current route
     * @return array
     */
    public static function getRoute()
    {
        return self::$route;
    }

    /**
     * Search url in list routes
     * @param $url - route address
     * @return bool
     */
    public static function matchRoute($url)
    {
        foreach (self::$routes as $key => $route) {
            if (preg_match("#$key#i", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                // prefix for admin controllers
                if (!isset($route['prefix'])) {
                    $route['prefix'] = '';
                } else {
                    $route['prefix'] .= '\\';
                }

                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    /**
     * Redirect url to current route
     * Фабрика для объектов контроллера
     * @param $url
     * @throws \Exception
     */
    public static function dispatch($url)
    {
        $url = self::removeQuerystring($url);
        if (self::matchRoute($url)) {
            //define the connection controller
            $controller = 'app\\Controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';

            if (class_exists($controller)) {
                $cObj = new $controller(self::$route);

                $action = self::lowerCamelCase(self::$route['action'] . 'Action');
                if (method_exists($cObj, $action)) {
                    $cObj->$action();

                    $cObj->getView();
                } else {
                    throw  new \Exception('page not found  controller=> action', 404);
                }
            } else {
                throw  new \Exception('page not found  controller', 404);

            }
        } else {
            throw  new \Exception('page not found', 404);
        }
    }

    /**
     * Converting controller and action to uppercase
     * @param $data
     * @return string|string[]
     */
    protected static function upperCamelCase($data)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $data)));
    }

    /**
     * Сasting the controller to lowercase
     * @param $data
     * @return string
     */
    protected static function lowerCamelCase($data)
    {
        return lcfirst(self::upperCamelCase($data));
    }

    /**
     * Получение строки с Get параметрами и передача ее для обработки в dispatch
     * @param $url
     * @return mixed
     */
    protected static function removeQuerystring($url)
    {

        if ($url) {
            $params = explode('&', $url, 2);
            if (false === strpos($params[0], '=')) {
                return rtrim($params[0], '/');
            } else {
                return '';
            }
        }
    }
}

