<?php

use yii\db\Migration;

class m170215_052526_product extends Migration
{
    public function up()
    {
        $this->execute(<<<SQL
            CREATE TABLE `imc`.`bs_product` (
                `id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
                `category_id` INT(9) UNSIGNED NULL,
                `brand_id` INT(9) UNSIGNED NULL,
                `gallery_id` INT(9) UNSIGNED NULL,
                `title` VARCHAR(255) NOT NULL,
                `description` TEXT NULL,
                `sku` VARCHAR(255) NULL,
                `price` FLOAT NULL DEFAULT 0,
                `picture` VARCHAR(255) NULL,
                `active` TINYINT NULL DEFAULT 1,
                `available` TINYINT NULL DEFAULT 1,
                `slug` VARCHAR(255) NULL,
                `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            );
SQL
        );
    }

    public function down()
    {
        $this->dropTable('bs_product');

        return false;
    }
}
