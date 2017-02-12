<?php

use yii\db\Migration;

class m170209_210622_bshop_base extends Migration
{
    public function up()
    {


        return true;
    }

    public function down()
    {
        $this->execute('DROP TABLE `category`');

        return true;
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
