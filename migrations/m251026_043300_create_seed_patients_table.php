<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%seed_patients}}`.
 */
class m251026_043300_create_seed_patients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('patients', ['first_name', 'last_name', 'gender', 'birth_date'], [
            ['Иван', 'Иванов', 'Мужской', '1985-06-15'],
            ['Мария', 'Петрова', 'Женский', '1990-09-22'],
            ['Алексей', 'Смирнов', 'Мужской', '1978-12-05'],
            ['Елена', 'Кузнецова', 'Женский', '1995-03-30'],
            ['Дмитрий', 'Васильев', 'Мужской', '1982-11-11'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('patients', [
            'first_name' => [
                'Иван',
                'Мария',
                'Алексей',
                'Елена',
                'Дмитрий',
            ],
        ]);
    }
}


