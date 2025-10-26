<?php

use yii\helpers\Url;
use app\assets\HomeAsset;
HomeAsset::register($this);
$this->title = 'Doctor Time';
$userName = Yii::$app->user->identity ? Yii::$app->user->identity->fullname : 'Гость';
?>

<div class="user-greeting">
    <div class="greeting-text">Добро пожаловать в Doctor Time,</div>
    <div class="greeting-name">
        <?= htmlspecialchars($userName) ?>
    </div>
</div>

<h2 style="text-align: center; color: var(--color-text); margin-bottom: 30px; font-weight: 600;">
    Выберите интересующую вас услугу:
</h2>

<div class="btn_container">
    <button data-link="<?= Url::to(['site/patients']) ?>" class='redirect_btn'>Посмотреть пациентов</button>
    <button data-link="<?= Url::to(['site/appointments']) ?>" class='redirect_btn'>Посмотреть записи</button>
    <button data-link="<?= Url::to(['site/create-appointments']) ?>" class='redirect_btn'>Создать запись</button>


</div>

<div style="height: 50px;"></div>