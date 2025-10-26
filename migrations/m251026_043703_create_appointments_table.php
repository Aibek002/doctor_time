<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%appointments}}`.
 */
class m251026_043703_create_appointments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%appointments}}', [
            'id' => $this->primaryKey(),
            'doctor_name' => $this->string(255)->notNull(),
            'specialization' => $this->string(255)->notNull(),
            'date_time' => $this->date(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%appointments}}');
    }
}
