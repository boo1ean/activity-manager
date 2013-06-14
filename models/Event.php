<?php

namespace app\models; 

use Yii;
use yii\db\ActiveRecord;

class Event extends ActiveRecord {
    public $id;
    public $create_time;
    public $update_time;
    public $created_by;
    public $updated_by;
    public $name;
    public $description;
    public $user_id;
    public $event_start;
    public $event_end;
    public $repeat_type;
    
    const TYPE_REPEAT_DAILY = 'DAILY';
    const TYPE_REPEAT_MONTHLY = 'MONTHLY';
    const TYPE_REPEAT_YEARLY = 'YEARLY';
    
    static function tableName() {
        return 'event';
    }
    
    public function behaviors() {
        return array(
            'timestamp' => array(
                'class' => 'yii\behaviors\AutoTimestamp',
            ),
//            'creater' => array(
//                'class' => 'app\behaviors\AutoCreater',
//            ),
        );
    }
    
    /**
     * Rules for validation
     * 
     * @return type
     */
    public function rules(){
        return array(
            array('name, user_id, event_start, event_end, repeat_type', 'required'),
            array('name', 'string'),
            array('user_id, id', 'integer'),
            array('user_id', 'checkUser', 'on' => 'save'),
            array('event_start, event_end', 'date', 'format' => 'Y-m-d H:i:s'),
            array('repeat_type', 'checkRepeatType'),
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
        return $this->hasMany('User', array('id' => 'event_id'))
            ->viaTable('event_member', array('user_id' => 'id'));
    }
    
    /**
     * Wiring up User table to Event through user_id 
     * 
     * @return type
     */
    public function getUser() {
        return $this->hasOne('User', array('user_id' => 'id'));
    }

    /**
     * Validation method. Check on valid event repeat type
     * 
     * @param string $repeatType
     */
    public function checkRepeatType($repeatType){
        if(!empty($repeatType) && $repeatType != self::TYPE_REPEAT_DAILY && $repeatType != self::TYPE_REPEAT_MONTHLY && $repeatType != self::TYPE_REPEAT_YEARLY){
            $this->addError('repeat_type', 'Incorrect repeat type.');
        }
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
     * @return type
     */
    public function getEventList($onlyNew = false){
        $events = self::find();
        
        if($onlyNew){
            $events->where(array(
                'or', 
                'event_start >= NOW()',
                'event_end >= NOW()'
            ));
        }
        
        return $events->all();
    }
    
    public function getEventById($eventId){
        $this['id'] = $eventId;
        
        if($this->validate(array('id'))){
            return self::find($this['id']);
        }
        
        return null;
    }
}

?>
