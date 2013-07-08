<?php

namespace app\behaviors;

use yii\base\Behavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use Yii;

class AutoCreator extends Behavior {

    public $attributes = array(
        ActiveRecord::EVENT_BEFORE_INSERT => 'created_by',
        ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_by',
    );

    public function events()
    {
        $events = $this->attributes;
        foreach ($events as $i => $event) {
            $events[$i] = 'updateCreater';
        }
        return $events;
    }

    public function updateCreater($event) {
        $attributes = isset($this->attributes[$event->name]) ? (array)$this->attributes[$event->name] : array();
        if (!empty($attributes)) {
            $userId = Yii::$app->getUser()->getId();
            foreach ($attributes as $attribute) {
                $this->owner->$attribute = $userId;
            }
        }
    }

}
