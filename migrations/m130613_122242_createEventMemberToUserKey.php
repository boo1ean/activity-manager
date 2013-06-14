<?php

class m130613_122242_createEventMemberToUserKey extends \yii\db\Migration {

    public function up() {
        $this->addForeignKey('fk_event_member_user', 'event_member', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        return true;
    }

    public function down() {
        $this->dropForeignKey('fk_event_member_user', 'event_member');
        return true;
    }

}
