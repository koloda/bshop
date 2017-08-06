<?php

use yii\db\Migration;

class m170215_042108_property extends Migration
{
    public function up()
    {
        $this->execute(<<<SQL
            CREATE TABLE `imc`.`bs_property` (
                `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `title` VARCHAR(255) NOT NULL,
                `active` TINYINT NULL DEFAULT 1,
                PRIMARY KEY (`id`)
            );
                
            CREATE TABLE `imc`.`bs_property_value` (
                `id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
                `property_id` INT(9) UNSIGNED NOT NULL,
                `value` VARCHAR(100) NOT NULL,
                `position` INT(3) NULL DEFAULT 0,
                PRIMARY KEY (`id`)
            );

SQL
        );
    }

    public function down()
    {
        $this->dropTable('bs_property');
        $this->dropTable('bs_property_value');
        
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
