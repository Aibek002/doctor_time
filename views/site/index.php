<?php
/** @var yii\web\View $this */
/** @var array $care List of medical care services */

$this->title = 'Doctor Time';

// Получаем имя пользователя. В реальном коде это должно быть выведено корректно.
$userName = Yii::$app->user->identity ? Yii::$app->user->identity->fullname : 'Гость';
?>

<style>
    /*
     * CSS Styles for a modern, clean, and professional medical interface
     */
    
    :root {
        --color-primary: #1D4ED8; /* Deep Blue */
        --color-primary-light: #EFF6FF; /* Very Light Blue */
        --color-text: #1F2937; /* Dark Grey Text */
        --color-background: #F9FAFB; /* Off-White Background */
        --color-shadow: rgba(29, 78, 216, 0.1); /* Light Blue Shadow */
    }

    body {
        background-color: var(--color-background);
        font-family: 'Inter', sans-serif;
    }

    /* --- User Greeting Section --- */
    .user-greeting {
        text-align: center;
        margin-bottom: 40px;
        padding: 30px 20px;
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .greeting-text {
        font-size: 1.25rem;
        color: #6B7280;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .greeting-name {
        font-size: 2rem;
        font-weight: 700;
        color: var(--color-primary);
        line-height: 1.2;
    }

    /* --- Buttons Grid --- */
    .care_container {
        display: grid;
        /* Адаптивная сетка: 2-4 столбца */
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); 
        gap: 20px;
        max-width: 1200px;
        margin: 0 auto; /* Центрирование */
        padding: 0 15px;
    }

    .care_btn {
        width: 100%;
        padding: 40px 20px;
        border: 2px solid var(--color-primary-light);
        border-radius: 12px;
        background-color: #ffffff;
        color: var(--color-text);
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        text-align: center;
        transition: all 0.3s ease;
        line-height: 1.4;
        
        /* Мягкая тень для придания глубины */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
    }

    .care_btn:hover {
        border-color: var(--color-primary);
        background-color: var(--color-primary);
        color: #ffffff;
        transform: translateY(-5px); /* Эффект подъема */
        box-shadow: 0 10px 20px var(--color-shadow);
    }

    .care_btn:active {
        transform: translateY(0);
        box-shadow: 0 5px 10px var(--color-shadow);
        background-color: #1E40AF; /* Darker shade on click */
    }

    /* Адаптивность для очень маленьких экранов */
    @media (max-width: 500px) {
        .care_container {
            grid-template-columns: 1fr;
        }
        .user-greeting {
            padding: 20px 15px;
        }
        .greeting-name {
            font-size: 1.5rem;
        }
    }

</style>

<!-- ======================= -->
<!-- HTML STRUCTURE -->
<!-- ======================= -->

<div class="user-greeting">
    <div class="greeting-text">Добро пожаловать в Doctor Time,</div>
    <div class="greeting-name">
        <!-- PHP: Вывод имени пользователя -->
        <?= htmlspecialchars($userName) ?>
    </div>
</div>

<h2 style="text-align: center; color: var(--color-text); margin-bottom: 30px; font-weight: 600;">
    Выберите интересующую вас услугу:
</h2>

<div class="care_container">
    <?php
    // Предполагаем, что $care — это массив объектов с полем care_name
    foreach ($care as $c) {
        // Добавлено htmlspecialchars для безопасности
        echo "<button class='care_btn'>" . htmlspecialchars($c->care_name) . "</button>";
    }
    ?>
</div>

<div style="height: 50px;"></div> <!-- Отступ снизу -->
