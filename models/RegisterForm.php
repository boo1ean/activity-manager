<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegisterForm extends User {

    public $password2;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return array(
            array('first_name', 'filter', 'filter' => 'trim'),
            array('first_name', 'required'),
            array('first_name', 'string'),

            array('last_name', 'filter', 'filter' => 'trim'),
            array('last_name', 'required'),
            array('last_name', 'string'),

            array('email', 'filter', 'filter' => 'trim'),
            array('email', 'required'),
            array('email', 'email'),
            array('email', 'unique', 'message' => 'This email address has already been taken.'),

            array('password', 'required'),
            array('password', 'string', 'min' => 6),

            array('password2', 'required'),
            array('password2', 'string', 'min' => 6),
            array('password2', 'compare', 'compareAttribute'=>'password'),
        );
    }

    public function register() {
        if ($this->validate()) {
            return $this->save();
        } else {
            return false;
        }
    }
}
