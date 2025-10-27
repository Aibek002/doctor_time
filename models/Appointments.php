<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appointments".
 *
 * @property int $id
 * @property string $doctor_name
 * @property string $patient_id
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
            [['patient_id'], 'default', 'value' => null],
            [['date_time'], 'default', 'value' => null],
            [['doctor_name', 'specialization', 'patient_id', 'date_time'], 'required'],
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
            'patient_id' => 'Patient ID',
            'specialization' => 'Specialization',
            'date_time' => 'Date Time',
        ];
    }
    public function getPatient()
    {
        return $this->hasOne(Patients::class, ['id' => 'patient_id']);
    }


}
