<?php

class m130613_121916_createEventMemberIndexes extends \yii\db\Migration {
    public function up() {
        $this->createIndex('idx_event_member', 'event_member', 'user_id, event_id');
        return true;
    }

    public function down() {
        $this->dropIndex('idx_event_member', 'event_member');
        return true;
    }
}
