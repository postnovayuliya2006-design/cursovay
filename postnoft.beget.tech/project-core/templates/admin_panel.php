<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Административная панель</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

<!-- 🔝 NAVBAR (как на основном сайте) -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow mb-4">
    <div class="container">

        <a class="navbar-brand fw-bold" href="index.php">
            💼 HR Agency
        </a>

        <div class="ms-auto d-flex gap-2">

            <?php if(isset($_SESSION['user_id'])): ?>

                <a href="index.php?route=home" class="btn btn-outline-light btn-sm">
                    👨‍💼 Сайт
                </a>

                <a href="index.php?route=logout" class="btn btn-danger btn-sm">
                    Выйти
                </a>

            <?php endif; ?>

        </div>

    </div>
</nav>

<!-- 📦 CONTENT -->
<div class="container py-4">

    <h2 class="fw-bold mb-4">🛠 Административная панель</h2>

    <div class="list-group shadow-sm">

        <!-- управление кандидатами -->
        <a href="index.php?route=home"
           class="list-group-item list-group-item-action">
            👨‍💼 Управление кандидатами
        </a>

        <!-- генератор -->
        <a href="/run_seeder.php"
           class="list-group-item list-group-item-action">
            ⚙ Генератор тестовых данных
        </a>

        <!-- заявки -->
        <a href="index.php?route=admin_applications"
           class="list-group-item list-group-item-action">
            📩 Заявки пользователей
        </a>

    </div>

</div>

</body>
</html>