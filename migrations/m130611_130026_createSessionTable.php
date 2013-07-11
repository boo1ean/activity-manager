<?php
use \yii\db\Schema;

class m130611_130026_createSessionTable extends \yii\db\Migration {
    public function up() {
        $this->createTable('tbl_session', array(
            'id' => Schema::TYPE_STRING,
            'expire' => Schema::TYPE_INTEGER,
            'data' => 'BLOB'
        ));

        return true;
    }

    public function down() {
        echo "m130611_130026_createSessionTable cannot be reverted.\n";
        return false;
    }
}
