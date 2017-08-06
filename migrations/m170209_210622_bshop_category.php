<?php

use yii\db\Migration;

class m170209_210622_bshop_category extends Migration
{
    public function up()
    {
        $this->execute(<<<SQL
            CREATE TABLE IF NOT EXISTS `imc`.`bs_category` (
                `id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
                `parent_id` INT(9) UNSIGNED NULL,
                `title` VARCHAR(255) NOT NULL,
                `description` TEXT NULL,
                `picture` VARCHAR(255) NULL,
                `active` TINYINT NULL DEFAULT 1,
                `show_in_menu` TINYINT NULL DEFAULT 1,
                `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                
                PRIMARY KEY (`id`),
                INDEX `parent` (`parent_id` ASC),
                INDEX `title` (`title` ASC),
                FULLTEXT INDEX `description` (`description` ASC),
                INDEX `active` (`active` ASC)
            );
SQL
        );

        return true;
    }

    public function down()
    {
        $this->dropTable('{{%category}}');

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
