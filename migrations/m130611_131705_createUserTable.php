<?php

use \yii\db\Schema;

class m130611_131705_createUserTable extends \yii\db\Migration {

    public function up() {
        $this->createTable('user', array(
            'id' => Schema::TYPE_PK,
            'created_time' => Schema::TYPE_TIMESTAMP,
            'updated_time' => Schema::TYPE_TIMESTAMP,
            'created_by' => Schema::TYPE_INTEGER,
            'updated_by' => Schema::TYPE_INTEGER,
            'first_name' => Schema::TYPE_STRING,
            'last_name' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING,
        ));

        return true;
    }

    public function down() {
        $this->dropTable('user');
        return true;
    }

}
