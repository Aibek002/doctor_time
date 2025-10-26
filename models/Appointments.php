<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appointments".
 *
 * @property int $id
 * @property string $doctor_name
 * @property string $specialization
 * @property string|null $date_time
 */
class Appointments extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appointments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_time'], 'default', 'value' => null],
            [['doctor_name', 'specialization'], 'required'],
            [['date_time'], 'safe'],
            [['doctor_name', 'specialization'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doctor_name' => 'Doctor Name',
            'specialization' => 'Specialization',
            'date_time' => 'Date Time',
        ];
    }

}
