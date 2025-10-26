<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%seed_medical_care}}`.
 */
class m251025_184716_create_seed_medical_care_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('medical_care', ['care_name'], [
            ['Терапевт'],
            ['Психиатр'],
            ['Травматолог'],
            ['Кардиолог'],
            ['Хирург'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('medical_care');
    }
}
