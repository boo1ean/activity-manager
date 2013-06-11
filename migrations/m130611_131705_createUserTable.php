<?php

use \yii\db\Schema;

class m130611_131705_createUserTable extends \yii\db\Migration {

    public function up() {
        $this->createTable('user', array(
            'id' => Schema::TYPE_PK,
            'created_date' => Schema::TYPE_DATETIME,
            'updated_date' => Schema::TYPE_DATETIME,
            'created_by' => Schema::TYPE_INTEGER,
            'update_by' => Schema::TYPE_INTEGER,
            'first_name' => Schema::TYPE_STRING,
            'last_name' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING,
        ));
        
        $this->createIndex('idx_user_name', 'user', 'email', true);

        return true;
    }

    public function down() {
        $this->dropTable('user');
        return true;
    }

}
