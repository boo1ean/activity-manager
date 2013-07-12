<?php

namespace app\models;

use yii\base\Model;
use app\libs\widgets\BitlyUrl;
use app\libs\helpers\mail\Mailer;

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
            $mailer = new Mailer();
            $mailer->send(
                $this->email,
                'Binary Activity Manager Test',
                 BitlyUrl::widget(array('url' => 'http://binary-studio.com', 'expand' => false))
            );

            return true;
        }

        return false;
    }

}