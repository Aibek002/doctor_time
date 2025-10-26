<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m251025_175252_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'fullname' => $this->text()->notNull(),
            'password_hash' => $this->text()->notNull(),
            'gender' => $this->text()->notNull(),
            'phone' => $this->text()->notNull(),
            'birthday' => $this->text()->notNull(),
            'email' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
