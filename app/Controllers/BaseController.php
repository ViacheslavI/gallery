<?php


namespace app\Controllers;


use app\Models\User;
use vendor\core\base\Controller;

class BaseController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);


    }
}