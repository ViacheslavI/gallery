<?php


namespace app\Controllers;


use app\Models\User;
use vendor\core\base\View;

class UserController extends BaseController
{
    public function signupAction()
    {
        if (!empty($_POST)) {
            $user = new User();
            $data = $_POST;
            $user->load($data);
            if (!$user->checkMailAndName($data) && !$user->validate($data)) {
                $user->getErrors();
                $_SESSION['form_data'] = $data;
                redirect();
            }
            if (!$user->save($data)) {
                $_SESSION['success'] = 'Вы успешно зарегистрировались';
                redirect('login');

            } else {
                $_SESSION['error'] = 'Ошибка попробуйте еще раз';
                redirect();
            }

        }
        View::setMeta('Registration');
    }

    public function loginAction()
    {
        if (!empty($_POST)) {
            $user = new User();
            $data = $_POST;
            $user->load($data);
            if ($user->login()) {
                $_SESSION['email'] = $data['email'];
                $_SESSION['success'] = 'Выуспешно авторизованы';
                redirect('/');
            } else {
                    $_SESSION['error'] = 'Логин/пароль введены не верно';
            }
            redirect('login');
        }
        View::setMeta('Login');
    }

    public function logoutAction()
    {
        if (isset($_SESSION['email'])) {
            unset($_SESSION['email']);
        }
        redirect('login');
    }
}