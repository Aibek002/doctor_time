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
<?php
$doctors = \app\models\Users::find()->orderBy(['fullname' => SORT_ASC])->all();
$patients = \app\models\Patients::find()->orderBy(['last_name' => SORT_ASC, 'first_name' => SORT_ASC])->all();
$specializations = \app\models\MedicalCare::find()->orderBy(['care_name' => SORT_ASC])->all();

?>

<div class="filter-bar" data-url="<?= Url::to(['ajax/filter']) ?>"
    style="margin:20px 0;display:flex;gap:10px;align-items:center;">
    <label for="patient-filter" style="font-weight:600;white-space:nowrap;">Пациент:</label>
    <select id="patient-filter" class="form-control" style="min-width:200px;">
        <option value="">Все пациенты</option>
        <?php foreach ($patients as $p): ?>
            <option value="<?= Html::encode($p->id) ?>"><?= Html::encode($p->first_name . ' ' . $p->last_name) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="doctor-filter" style="font-weight:600;white-space:nowrap;margin-left:10px;">Врач:</label>
    <select id="doctor-filter" class="form-control" style="min-width:200px;">
        <option value="">Все врачи</option>
        <?php foreach ($doctors as $d): ?>
            <option value="<?= Html::encode($d->fullname) ?>"><?= Html::encode($d->fullname) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="specialization-filter" style="font-weight:600;white-space:nowrap;margin-left:10px;">Спец.:</label>
    <select id="specialization-filter" class="form-control" style="min-width:200px;">
        <option value="">Все специализации</option>
        <?php foreach ($specializations as $s): ?>
            <option value="<?= Html::encode($s->care_name) ?>"><?= Html::encode($s->care_name) ?></option>
        <?php endforeach; ?>
    </select>

    <div id="filter-loader" style="display:none;margin-left:10px;">Загрузка...</div>
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
            
                <button class="btn btn-danger redirect_btn"
                    data-link="<?= Url::to(['site/cancel-appointment', 'id' => $appointment->id]) ?>"
                    onclick="return confirm('Вы уверены, что хотите удалить запись?')">
                    🗑 Отменить
                </button>
            </div>

            <div class="status-text" style="margin-top: 10px;">
                Статус:
                <span style="color: <?= $appointment->status ? 'green' : 'red' ?>;">
                    <?= Html::encode($appointment->status ? 'Активна' : 'Неактивна') ?>
                </span>

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