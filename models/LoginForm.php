<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
	public $email;
	public $password;
	public $rememberMe = true;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return array(
			// email and password are both required
			array('email, password', 'required'),
			// password is validated by validatePassword()
			array('password', 'validatePassword'),
			// rememberMe must be a boolean value
			array('rememberMe', 'boolean'),
		);
	}

	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 */
	public function validatePassword()
	{
		$user = User::findByUsername($this->email);
		if (!$user || !$user->validatePassword($this->password)) {
			$this->addError('password', 'Incorrect username or password.');
		}
	}

	/**
	 * Logs in a user using the provided email and password.
	 * @return boolean whether the user is logged in successfully
	 */
	public function login()
	{
		if ($this->validate()) {
			$user = User::findByUsername($this->email);
			Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0);
			return true;
		} else {
			return false;
		}
	}
}
