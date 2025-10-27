<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\assets\AppointmentAsset;
AppointmentAsset::register($this);
$this->title = 'Список записей на приём';
$appointments = $provider->getModels();
$pagination = $provider->pagination;
?>

<div class="page-title">
    <span style="color: var(--color-primary);">Doctor</span>
    <span style="color: var(--color-text);">Time</span>
    Записи на приём
</div>

<div class="appointments-list-container">
    <?php
    if (empty($appointments)) {
        echo '<div style="text-align: center; grid-column: 1 / -1; color: #DC2626; font-style: italic; margin-bottom: 20px; padding: 10px; background-color: #FEF2F2; border-radius: 8px;">' .
            'Пока нет записей на приём.' .
            '</div>';
    }
    ?>

    <?php foreach ($appointments as $appointment): ?>
        <div class="appointment-card" title="Нажмите для подробностей">
            <h3 style="margin-bottom: 10px;">
                👨‍⚕️ <?= Html::encode($appointment->doctor_name) ?>
            </h3>

            <div class="info-line">
                🧑‍🤝‍🧑 Пациент: 
                <strong>
                    <?= Html::encode($appointment->patient->first_name . ' ' . $appointment->patient->last_name) ?>
                </strong>
            </div>

            <div class="info-line">
                🩺 Специализация: 
                <strong><?= Html::encode($appointment->specialization) ?></strong>
            </div>

            <div class="info-line">
                ⏰ Дата и время приёма: 
                <strong><?= Yii::$app->formatter->asDatetime($appointment->date_time, 'php:d.m.Y H:i') ?></strong>
            </div>

            <div class="button-container" style="margin-top: 20px;">
                <button class="btn btn-primary redirect_btn"
                    data-link="<?= Url::to(['appointments/update', 'id' => $appointment->id]) ?>">
                    ✏️ Изменить
                </button>
                <button class="btn btn-danger redirect_btn"
                    data-link="<?= Url::to(['appointments/delete', 'id' => $appointment->id]) ?>"
                    onclick="return confirm('Вы уверены, что хотите удалить запись?')">
                    🗑 Удалить
                </button>
            </div>

            <div class="status-text" style="margin-top: 10px;">
                Статус: <span style="color: green;">Активна</span>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div style="height: 50px;"></div>
<div style="text-align:center; margin-top: 30px;">
    <?= LinkPager::widget([
        'pagination' => $pagination,
        'maxButtonCount' => 5,
    ]) ?>
</div>

<?php
$js = <<<JS
$(".redirect_btn").on("click", function() {
    window.location.href = $(this).data("link");
});
JS;
$this->registerJs($js);
?>
