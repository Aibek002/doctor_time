<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%medical_care}}`.
 */
class m251025_184609_create_medical_care_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%medical_care}}', [
            'id' => $this->primaryKey(),
            'care_name' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%medical_care}}');
    }
}
