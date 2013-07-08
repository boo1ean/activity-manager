<?php

use \yii\db\Schema;

class m130613_121341_createEventMembersTable extends \yii\db\Migration {

    public function up() {
        $this->createTable('event_member', array(
            'id' => Schema::TYPE_PK,
            'create_time' => Schema::TYPE_TIMESTAMP,
            'update_time' => Schema::TYPE_TIMESTAMP,
            'created_by' => Schema::TYPE_INTEGER,
            'updated_by' => Schema::TYPE_INTEGER,
            'event_id' => Schema::TYPE_INTEGER,
            'user_id' => Schema::TYPE_INTEGER,
            'status' => Schema::TYPE_SMALLINT,
        ));

        return true;
    }

    public function down() {
        $this->dropTable('event_member');
        return true;
    }

}
