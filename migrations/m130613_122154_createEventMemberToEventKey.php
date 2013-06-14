<?php

class m130613_122154_createEventMemberToEventKey extends \yii\db\Migration {

    public function up() {
        $this->addForeignKey('fk_event_member_events', 'event_member', 'event_id', 'event', 'id', 'CASCADE', 'CASCADE');
        return true;
    }

    public function down() {
        $this->dropForeignKey('fk_event_member_events', 'event_member');
        return true;
    }

}
