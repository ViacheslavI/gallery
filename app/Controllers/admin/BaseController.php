<?php


namespace app\Controllers\admin;


use app\Models\User;
use vendor\core\base\Controller;

class BaseController extends Controller
{
    //шаблон для админ представления
    public $layout = 'admin';

    public function __construct($route)
    {
        parent::__construct($route);
        if (!User::isUser() && $route['action'] != 'login' || $route['action']['user'] != 'admin') {
            redirect(USER . '/user/login');
        }
    }
}