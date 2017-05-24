<?php

use yii\db\Migration;

class m170524_205604_category_slug extends Migration
{
    public function up()
    {
        $this->execute('ALTER TABLE `imc`.`bs_category` '.
            ' ADD COLUMN `slug` VARCHAR(255) NOT NULL AFTER `updated_at`');

        return true;
    }

    public function down()
    {
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
