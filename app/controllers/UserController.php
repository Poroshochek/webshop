<?php


namespace app\controllers;


use app\models\User;

class UserController extends AppController
{
    public function loginAction()
    {
        if (!empty($_POST)) {
            $user = new User();
            if ($user->login()) {
                $_SESSION['success'] = 'Вы успешно авторизовались';
            } else {
                $_SESSION['error'] = 'Неверный логин или пароль';
            }
            redirect();
        }
        $this->setMeta('Login');
    }

    public function signupAction()
    {
        if (!empty($_POST)) {
            $user = new User();
            $data = $_POST;
            $user->load($data);
            if (! $user->validate($data) || !$user->checkUnique()) {
                $user->getErrors();
                $_SESSION['form_data'] = $data;
            } else {
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                if ($user->save('user')) {
                    $_SESSION['success'] = 'Вы успешно зарегистрировались!';
                } else {
                    $_SESSION['error'] = 'Произошла неизвестная ошибка пожалуйста попробуйте через пару минут =)';
                }
                redirect();
            }
        }
        $this->setMeta('Registration');
    }

    public function logoutAction()
    {
        if (isset($_SESSION['user'])) unset($_SESSION['user']);
        redirect();
    }
}