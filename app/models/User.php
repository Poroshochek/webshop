<?php


namespace app\models;


class User extends AppModel
{
    public $attributes = [
      'login'       => '',
      'password'    => '',
      'email'       => '',
      'name'        => '',
      'address'     => ''
    ];
    public $rules = [
        'required' => [
            ['login'],
            ['password'],
            ['email'],
            ['name'],
            ['address'],
        ],
        'email' => [
            ['email'],
        ],
        'lengthMin' => [
            ['password', 6],
        ]
    ];

    public function checkUnique() : bool
    {
        $user = \R::findOne('user', 'login = ? OR email = ?', [$this->attributes['login'],
                                                                         $this->attributes['email']]);
        if ($user) {
            if ($user->login == $this->attributes['login']) {
                $this->errors['unique'][] = "Пользователь с логином <b>" . $user->login . "</b> уже зарегистрирован в системе";
            }
            if ($user->email == $this->attributes['email']) {
                $this->errors['unique'][] = "Пользователь с почтой <b>" . $user->email . "</b> уже зарегистрирован в системе";
            }
            return false;
        }
        return true;
    }

    public function login($isAdmin = false) : bool
    {
        $login = !empty(trim($_POST['login'])) ? trim($_POST['login']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;
        if ($login && $password) {
            if ($isAdmin) {
                $user = \R::findOne('user', "login = ? AND role = 'admin'", [$login]);
            } else {
                $user = \R::findOne('user', "login = ?", [$login]);
            }
            if ($user) {
                if(password_verify($password, $user->password)) {
                    foreach ($user as $k => $v) {
                        if ($k !== 'password') {
                            $_SESSION['user'][$k] = $v;
                        }
                    }
                    return true;
                }
            }
        }
        return false;
    }
}