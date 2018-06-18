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

    public function checkUnique()
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
}