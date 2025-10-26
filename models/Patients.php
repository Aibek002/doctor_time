<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patients".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $brith_date
 * @property string|null $gender
 */
class Patients extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gender'], 'default', 'value' => null],
            [['first_name', 'last_name', 'brith_date'], 'required'],
            [['brith_date'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['gender'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'brith_date' => 'Brith Date',
            'gender' => 'Gender',
        ];
    }

}
