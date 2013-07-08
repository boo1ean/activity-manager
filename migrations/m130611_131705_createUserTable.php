<?php

use \yii\db\Schema;

class m130611_131705_createUserTable extends \yii\db\Migration {

    public function up() {
        $this->createTable('user', array(
            'id' => Schema::TYPE_PK,
            'create_time' => Schema::TYPE_TIMESTAMP,
            'update_time' => Schema::TYPE_TIMESTAMP,
            'first_name' => Schema::TYPE_STRING,
            'last_name' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING,
            'password' => Schema::TYPE_STRING,
        ));

        return true;
    }

    public function down() {
        $this->dropTable('user');
        return true;
    }

}
