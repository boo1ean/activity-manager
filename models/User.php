<?php

namespace app\models;

class User extends \yii\db\ActiveRecord implements \yii\web\Identity
{

    public static function tableName() {
        return 'user';
    }

	public static function findIdentity($id)
	{
        return self::find($id);
	}

	public static function findByUsername($username)
	{
		return self::find(array(
            'email' => $username
        ));
	}

	public function getId()
	{
		return $this->id;
	}

	public function getAuthKey() {}

	public function validateAuthKey($authKey) {}

	public function validatePassword($password)
	{
		return $this->password === md5($password);
	}
}
