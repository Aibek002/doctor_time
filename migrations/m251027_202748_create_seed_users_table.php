<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%seed_users}}`.
 */
class m251027_202748_create_seed_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->batchInsert('users', ['fullname', 'email', 'password_hash', 'auth_key'], [
            ['Иван Иванов', 'ivan@example.com', '$2y$10$abcdefg', 'auth_key_1'],
            ['Мария Петрова', 'maria@example.com', '$2y$10$hijklmn', 'auth_key_2'],
            ['Алексей Смирнов', 'alexey@example.com', '$2y$10$opqrstu', 'auth_key_3'],
            ['Елена Кузнецова', 'elena@example.com', '$2y$10$vwxyz12', 'auth_key_4'],
            ['Дмитрий Васильев', 'dmitry@example.com', '$2y$10$34567890', 'auth_key_5'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%seed_users}}');
    }
}
