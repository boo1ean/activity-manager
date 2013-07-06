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

    public function events() {
        $events = array();
        $behavior = $this;
        
        foreach ($this->attributes as $event => $attributes) {
            if (!is_array($attributes)) {
                $attributes = array($attributes);
            }
            
            $events[$event] = function () use ($behavior, $attributes) {
                $behavior->updateCreater($attributes);
            };
        }
        return $events;
    }

    public function updateCreater($attributes) {
        $userId = Yii::$app->getUser()->getId();
        foreach ($attributes as $attribute) {
            $this->owner->$attribute = $userId;
        }
    }

}
