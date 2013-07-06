<?php

use \yii\db\Schema;

class m130613_113042_createEventTable extends \yii\db\Migration {

    public function up() {
        $this->createTable('event', array(
            'id' => Schema::TYPE_PK,
            'create_time' => Schema::TYPE_TIMESTAMP,
            'update_time' => Schema::TYPE_TIMESTAMP,
            'created_by' => Schema::TYPE_INTEGER,
            'updated_by' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING,
            'description' => Schema::TYPE_TEXT,
            'start_time' => Schema::TYPE_DATETIME,
            'end_time' => Schema::TYPE_DATETIME,
        ));
        
        return true;
    }

    public function down() {
        $this->dropTable('event');
        
        return true;
    }

}
