<?php

use yii\db\Migration;


use yii\db\Schema;
class m170212_031916_gallery extends Migration
{
    public $tableName = '{{%gallery_image}}';

    public function up()
    {
        $existTables = $this->getDb()->getSchema()->getTableNames();
        
        if (!in_array('bs_gallery_image', $existTables)) {
            $this->createTable(
                $this->tableName,
                array(
                    'id' => Schema::TYPE_PK,
                    'type' => Schema::TYPE_STRING,
                    'ownerId' => Schema::TYPE_STRING . ' NOT NULL',
                    'rank' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
                    'name' => Schema::TYPE_STRING,
                    'description' => Schema::TYPE_TEXT
                )
            );
        }

        return true;
    }

    public function down()
    {
        $this->dropTable('{{%gallery_image}}');

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
