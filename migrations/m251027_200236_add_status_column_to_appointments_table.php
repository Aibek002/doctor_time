<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%appointments}}`.
 */
class m251027_200236_add_status_column_to_appointments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%appointments}}', 'status', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%appointments}}', 'status');
    }
}
