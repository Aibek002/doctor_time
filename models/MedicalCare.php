<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medical_care".
 *
 * @property int $id
 * @property string $care_name
 */
class MedicalCare extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medical_care';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['care_name'], 'required'],
            [['care_name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'care_name' => 'Care Name',
        ];
    }

}
