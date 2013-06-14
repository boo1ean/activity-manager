<?php

class m130614_123936_createEventUserIdIndex extends \yii\db\Migration {

    public function up() {
        $this->createIndex('idx_event_user_id', 'event', 'user_id');
        return true;
    }

    public function down() {
        $this->dropIndex('idx_event_user_id', 'event');
        return true;
    }

}
