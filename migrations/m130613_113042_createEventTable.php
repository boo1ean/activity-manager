<?php

use \yii\db\Schema;

class m130613_113042_createEventTable extends \yii\db\Migration {

    public function up() {
        $this->createTable('events', array(
            'id' => Schema::TYPE_PK,
            'created_date' => Schema::TYPE_DATETIME,
            'updated_date' => Schema::TYPE_DATETIME,
            'created_by' => Schema::TYPE_INTEGER,
            'update_by' => Schema::TYPE_INTEGER,
            'name' => Schema::TYPE_STRING,
            'description' => Schema::TYPE_TEXT,
            'user_id' => Schema::TYPE_INTEGER,
            'event_start' => Schema::TYPE_DATETIME,
            'event_end' => Schema::TYPE_DATETIME,
            'repeat_type' => 'varchar(40)',
        ));
        
        return true;
    }

    public function down() {
        $this->dropTable('events');
        
        return true;
    }

}
