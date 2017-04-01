<?php

namespace App\Model;

class User extends Elegant
{
    protected $table = 'users';
    protected $hidden = array(
        'password'
    );

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_BCRYPT);
    }

    public function authenticate($password)
    {
        return password_verify($password, $this->attributes['password']);
    }
}
