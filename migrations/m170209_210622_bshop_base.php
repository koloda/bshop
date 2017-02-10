<?php

use yii\db\Migration;

class m170209_210622_bshop_base extends Migration
{
    public function up()
    {
        $this->execute(<<<SQL

            CREATE TABLE `bs_category` (
                `id` int(6) UNSIGNED AUTO_INCREMENT,
                `paarent_id` int(6) UNSIGNED DEFAULT 0,
                `title` varchar(255) NOT NULL,
                `description` text,
                `created_at` timestamp,
                `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            )

SQL
        );

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
