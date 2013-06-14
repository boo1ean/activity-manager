<?php

class m130614_124044_createEventToUserKey extends \yii\db\Migration {

    public function up() {
        $this->addForeignKey('fk_event_users', 'event', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        return true;
    }

    public function down() {
        $this->dropForeignKey('fk_event_users', 'event');
        return true;
    }

}
