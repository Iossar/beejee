<?php

namespace config;

use app\Models\Database;

final class Bootstrap
{

    public static $routes = [];

    public function __construct()
    {
        new Database();
        self::$routes = [
            '/' => 'TaskController/index',
            '/task/get' => 'TaskController/get',
            '/task/show/:num' => 'TaskController/show/$1',
            '/task/edit/:num' => 'TaskController/edit/$1',
            '/task/edit' => 'TaskController/edit',
            '/task/add' => 'TaskController/add',
            '/registration' => 'UserController/registration',
            '/login' => 'UserController/login',
            '/logout' => 'UserController/logout',
        ];
    }

    public function run()
    {
        session_start();
        Router::addRoute(self::$routes);
        Router::dispatch();
    }


}
