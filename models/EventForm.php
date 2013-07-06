<?php

namespace app\models;

use yii\base\Model;

class EventForm extends Model {
    public $id;
    public $title;
    public $description;
    public $start_time;
    public $end_time;

    public function rules() {
        return array();
    }

    public function attributeLabels() {
        return array(
            'id'          => '',
            'title'       => 'Title',
            'description' => 'Description',
            'start_time'  => 'Start Time',
            'end_time'    => 'End Time'
        );
    }
}