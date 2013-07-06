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
        return array(
            array('id', 'default'),
            array('title, description, start_time, end_time', 'required'),
            array('title, description', 'string'),
            array('start_time', 'date', 'format' => 'Y-m-d H:i:s'),
            array('end_time', 'date', 'format' => 'Y-m-d H:i:s')
        );
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

    /**
     * Create new event
     *
     * @return Event|bool
     */
    public function createEvent() {
        if ($this->validate()) {
            /**
             * @var Event $event
             */
            $event              = new Event();
            $event->title       = $this->title;
            $event->description = $this->description;
            $event->start_time  = $this->start_time;
            $event->end_time    = $this->end_time;
            $event->save();

            return $event;
        }

        return false;
    }

    /**
     * Update existing event
     *
     * @return Event|bool
     */
    public function updateEvent() {
        if ($this->validate()) {
            /**
             * @var Event $event
             */
            $event = Event::findByID($this->id);
            if ($event) {
                $event->title       = $this->title;
                $event->description = $this->description;
                $event->start_time  = $this->start_time;
                $event->end_time    = $this->end_time;
                $event->save();
            } else {
                return false;
            }
        }

        return false;
    }

    public function saveEvent() {
        $result = (!empty($this->id)) ? $this->updateEvent() : $this->createEvent();
        return (!empty($result));
    }

    public function validateFormat() {
        return true;
    }
}