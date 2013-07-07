<?php

namespace app\models;

use yii\base\Model;

class InviteForm extends Model {
    public $event_id;
    public $email;

    public function rules() {
        return array(
            array('event_id', 'default'),
            array('email', 'email'),
            array('email', 'exist', 'className' => 'app\models\User', 'attributeName' => 'email')
        );
    }

    public function attributeLabels() {
        return array(
            'event_id'  => '',
            'title'     => 'Email',
        );
    }

    public function sendInvitation() {
        if ($this->validate()) {
            // TODO: send invitation with activation hash
            return true;
        }

        return false;
    }

}