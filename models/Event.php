<?php

namespace app\models; 

use Yii;
use yii\db\ActiveRecord;

class Event extends ActiveRecord {

    public static function tableName() {
        return 'event';
    }
    
    public function behaviors() {
        return array(
            'timestamp' => array(
                'class' => 'yii\behaviors\AutoTimestamp',
            ),
            'creator' => array(
                'class' => 'app\behaviors\AutoCreator',
            ),
        );
    }
    
    /**
     * Rules for validation
     * 
     * @return array
     */
    public function rules(){
        return array(
            /*array('name, user_id, event_start, event_end, repeat_type', 'required'),
            array('name', 'string'),
            array('id', 'integer'),
            array('checkUser', 'on' => 'save'),
            array('event_start, event_end', 'date', 'format' => 'Y-m-d H:i:s'),
            array('repeat_type', 'checkRepeatType'),*/
        );
    }
    
    public function scenarios() {
        $scenarios = parent::scenarios();
        
        return array(
            'default' => $scenarios['default'],
            'save' => $scenarios['default']
        );
    }
    
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->setScenario('save');
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Wiring up event Members (users) to Event through event_member table 
     * 
     * @return type
     */
    public function getMembers() {
        return $this->hasMany('User', array('id' => 'user_id'))
            ->viaTable('event_member', array('event_id' => 'id'));
    }
    
    /**
     * Wiring up User table to Event through user_id 
     * 
     * @return type
     */
    public function getUser() {
        return $this->hasOne('User', array('id' => 'created_by'));
    }

    /**
     * Validation method. Check on valid user_id
     * 
     * @param integer $userId
     */
    public function checkUser($userId){
        // TODO: Implemnet check on logged user after session will be implemented
    }


    /**
     * Get full event list
     *
     * @param bool $onlyNew
     * @return array
     */
    public static function getEventList($onlyNew = false) {
        $events = static::find();
        
        if ($onlyNew) {
            $events->where(array(
                'or', 
                'start_time >= NOW()',
                'end_time >= NOW()'
            ));
        }
        
        return $events->all();
    }

    /**
     * Find Event by ID
     *
     * @param $id
     * @return null|\yii\db\ActiveQuery|ActiveRecord
     */
    public static function findByID($id) {
        return static::find(array('id' => $id));
    }
}

