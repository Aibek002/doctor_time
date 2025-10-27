<?php

use app\models\MedicalCare;
use app\models\Patients;
use app\models\Users;
use yii\helpers\ArrayHelper; ?>

<?php $form = \yii\widgets\ActiveForm::begin(); ?>

<?= $form->field($model, 'patient_id')->dropDownList(ArrayHelper::map(
    Patients::find()->all(),
    'id',
    function ($patient) {
        return $patient->first_name . ' ' . $patient->last_name;
    }
), ['prompt' => 'Выберите пациента']) ?>
<!-- <?= $form->field($model, 'doctor_name')->dropDownList(ArrayHelper::map(Users::find()->all(), 'fullname', 'fullname'), ['prompt' => 'Выберите врача']) ?> -->
<?= $form->field($model, 'specialization')->dropDownList(ArrayHelper::map(MedicalCare::find()->all(), 'care_name', 'care_name'), ['prompt' => 'Выберите специализацию']) ?>
<?= $form->field($model, 'date_time')->input('datetime-local') ?>


<div class="form-group">
    <?= \yii\helpers\Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
<?php \yii\widgets\ActiveForm::end(); ?>