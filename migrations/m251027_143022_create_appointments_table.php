<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%appointments}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%patients}}`
 */
class m251027_143022_create_appointments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%appointments}}', [
            'id' => $this->primaryKey(),
            'doctor_name' => $this->string(255)->notNull(),
            'patient_id' => $this->integer()->notNull(),
            'specialization' => $this->string(255)->notNull(),
            'date_time' => $this->dateTime()->notNull(),
        ]);

        // creates index for column `patient_id`
        $this->createIndex(
            '{{%idx-appointments-patient_id}}',
            '{{%appointments}}',
            'patient_id'
        );

        // add foreign key for table `{{%patients}}`
        $this->addForeignKey(
            '{{%fk-appointments-patient_id}}',
            '{{%appointments}}',
            'patient_id',
            '{{%patients}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%patients}}`
        $this->dropForeignKey(
            '{{%fk-appointments-patient_id}}',
            '{{%appointments}}'
        );

        // drops index for column `patient_id`
        $this->dropIndex(
            '{{%idx-appointments-patient_id}}',
            '{{%appointments}}'
        );

        $this->dropTable('{{%appointments}}');
    }
}
