<?php


namespace app\Controllers\admin;


use vendor\core\base\View;

class UserController extends BaseController
{
    public function __construct($route)
    {
        parent::__construct($route);
    }

    public function indexAction()
    {
        View::setMeta('Main Page','Main admins page','keywords adminPanel');
    }

    public function testAction()
    {

    }


}