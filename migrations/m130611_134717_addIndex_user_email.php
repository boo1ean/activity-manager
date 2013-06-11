<?php

class m130611_134717_addIndex_user_email extends \yii\db\Migration {
    public function up() {
        $this->createIndex('idx_user_name', 'user', 'email', true);
        return true;
    }

    public function down() {
        $this->dropIndex('idx_user_name', 'user');
        return true;
    }
}
