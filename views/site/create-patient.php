<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Создание пациента';
?>
<div class="site-create-patient">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput() ?>



    <?= $form->field($model, 'brith_date')->textInput(['type' => 'date']) ?>
    <?= $form->field($model, 'gender')->dropDownList(['male' => 'male', 'female' => 'female']) ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
