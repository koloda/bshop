<?php

use yii\db\Migration;

class m170215_032648_brand extends Migration
{
    public function up()
    {
        $this->execute(<<<SQL
            CREATE TABLE `bs_brand` (
                `id` int(9) unsigned NOT NULL AUTO_INCREMENT,
                `title` varchar(255) NOT NULL,
                `description` text,
                `picture` varchar(255) DEFAULT NULL,
                `active` tinyint(4) DEFAULT '1',
                `slug` varchar(255) DEFAULT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `title_UNIQUE` (`title`)
            ) 
            ENGINE=InnoDB DEFAULT CHARSET=utf8;

SQL
        );

        return true;
    }

    public function down()
    {
        $this->dropTable('bs_brand');

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
