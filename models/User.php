<?php

namespace app\models;

use yii\helpers\SecurityHelper;

class User extends \yii\db\ActiveRecord implements \yii\web\Identity
{
    public $password2;

    public static function tableName() {
        return 'user';
    }

	public static function findIdentity($id) {
        return self::find($id);
	}

	public static function findByUsername($username) {
		return self::find(array(
            'email' => $username
        ));
	}

	public function getId() {
		return $this->id;
	}

    public function validatePassword($password) {
        return SecurityHelper::validatePassword($password, $this->password);
    }

    public function beforeSave($insert) {
        if(parent::beforeSave($insert)) {
            if(!empty($this->password)) {
                $this->password = SecurityHelper::generatePasswordHash($this->password);
            }
            return true;
        }
        return false;
    }
	public function getAuthKey() {}

	public function validateAuthKey($authKey) {}
}
