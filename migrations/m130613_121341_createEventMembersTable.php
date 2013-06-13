<?php

use \yii\db\Schema;

class m130613_121341_createEventMembersTable extends \yii\db\Migration {

    public function up() {
        $this->createTable('event_member', array(
            'id' => Schema::TYPE_PK,
            'created_date' => Schema::TYPE_DATETIME,
            'updated_date' => Schema::TYPE_DATETIME,
            'created_by' => Schema::TYPE_INTEGER,
            'update_by' => Schema::TYPE_INTEGER,
            'event_id' => Schema::TYPE_INTEGER,
            'user_id' => Schema::TYPE_INTEGER,
        ));

        return true;
    }

    public function down() {
        $this->dropTable('event_member');
        return true;
    }

}
