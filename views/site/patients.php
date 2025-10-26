<?php
use app\assets\PatientsAsset;
PatientsAsset::register($this);
$this->title = 'Список пациентов';

$patients = $provider->getModels();
$pagination = $provider->pagination;
?>
<div class="page-title">
    <span style="color: var(--color-primary);">Doctor</span> <span style="color: var(--color-text);">Time</span>
    Пациенты
</div>

<div class="patients-list-container">
    <?php
    if (!isset($patients) || empty($patients)) {
        $mockPatients = [
            (object) ['first_name' => 'Анна', 'last_name' => 'Иванова', 'brith_date' => '05.03.1990', 'gender' => 'Женский'],
            (object) ['first_name' => 'Сергей', 'last_name' => 'Петров', 'brith_date' => '12.11.1985', 'gender' => 'Мужской'],
            (object) ['first_name' => 'Мария', 'last_name' => 'Смирнова', 'brith_date' => '21.07.2001', 'gender' => 'Женский'],
        ];
        $patients = $mockPatients;
        echo '<div style="text-align: center; grid-column: 1 / -1; color: #DC2626; font-style: italic; margin-bottom: 20px; padding: 10px; background-color: #FEF2F2; border-radius: 8px;">' .
            'ВНИМАНИЕ: Используются тестовые данные для отображения дизайна.' .
            '</div>';
    }
    ?>

    <?php foreach ($patients as $patient):
        $genderIcon = ($patient->gender === 'Мужской') ? '👨' : '👩';
        $birthIcon = '🎂';
        ?>
        <div class="patient-card" title="Нажмите для просмотра или редактирования профиля">

            <h3>
                <?= htmlspecialchars($patient->first_name) . " " . htmlspecialchars($patient->last_name) ?>
            </h3>
            <div class="info-line">
                <span class="icon"><?= $birthIcon ?></span>
                <span>
                    Дата рождения: <strong><?= htmlspecialchars($patient->brith_date) ?></strong>
                </span>
            </div>
            <div class="info-line">
                <span class="icon"><?= $genderIcon ?></span>
                <span>
                    Пол: <strong><?= htmlspecialchars($patient->gender) ?></strong>
                </span>
            </div>
            <div class="button-container" style="margin-top: 20px;">
                <button class="btn btn-primary redirect_btn"
                    data-link="<?= \yii\helpers\Url::to(['site/update', 'id' => $patient->id]) ?>"> Редактировать</button>
                <button class="btn btn-danger redirect_btn"
                    data-link="<?= \yii\helpers\Url::to(['site/delete', 'id' => $patient->id]) ?>">Удалить</button>
            </div>
            <div class="status-text">
                Статус: Активен
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div style="height: 50px;"></div>
<div style="text-align:center; margin-top: 30px;">
    <?= \yii\widgets\LinkPager::widget([
        'pagination' => $pagination,
        'maxButtonCount' => 3,
    ]) ?>
</div>