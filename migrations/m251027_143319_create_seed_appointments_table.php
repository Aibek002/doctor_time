<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%seed_appointments}}`.
 */
class m251027_143319_create_seed_appointments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('appointments', ['patient_id', 'doctor_name', 'specialization', 'date_time'], [
            ['1', 'Иван Иванов', 'Терапевт', '2024-11-01 10:00:00'],
            ['2', 'Мария Петрова', 'Кардиолог', '2024-11-02 11:00:00'],
            ['3', 'Алексей Смирнов', 'Невролог', '2024-11-03 12:00:00'],
            ['4', 'Елена Кузнецова', 'Педиатр', '2024-11-04 13:00:00'],
            ['5', 'Дмитрий Васильев', 'Хирург', '2024-11-05 14:00:00'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('appointments', ['patient_id' => [1, 2, 3, 4, 5]]);
    }
}
