<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= !empty($candidate) ? 'Редактирование' : 'Добавление' ?> кандидата</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">💼 Кадровое агентство</a>

        <a href="index.php?route=home" class="btn btn-outline-light btn-sm">
            ← Назад
        </a>
    </div>
</nav>

<div class="container">

    <div class="card shadow-sm border-0 form-card p-4">

        <h3 class="mb-4 fw-bold text-center">
            <?= !empty($candidate) ? '✏ Редактирование кандидата' : '➕ Добавление кандидата' ?>
        </h3>

        <form method="POST" action="index.php?route=save_candidate" enctype="multipart/form-data">

            <?php if(!empty($candidate)): ?>
                <input type="hidden" name="id" value="<?= $candidate['id'] ?>">
            <?php endif; ?>

            <div class="mb-3">
                <label class="form-label">👤 Полное имя</label>
                <input type="text"
                       name="full_name"
                       class="form-control"
                       value="<?= $candidate['full_name'] ?? '' ?>"
                       placeholder="Введите ФИО"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">💼 Должность</label>
                <input type="text"
                       name="position"
                       class="form-control"
                       value="<?= $candidate['position'] ?? '' ?>"
                       placeholder="Например: Frontend Developer"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">💰 Ожидаемая зарплата</label>
                <input type="text"
                       name="expected_salary"
                       class="form-control"
                       value="<?= $candidate['expected_salary'] ?? '' ?>"
                       placeholder="Например: 1500$"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">🖼 Фото кандидата</label>
                <input type="file" name="photo" class="form-control">

                <?php if(!empty($candidate['photo_url'])): ?>
    <div class="mt-2">
        <small class="text-muted">Текущее фото:</small><br>
        <img src="/uploads/<?= $candidate['photo_url'] ?>"
             style="height:80px;border-radius:8px;margin-top:5px;">
        
        <input type="hidden" name="old_photo" value="<?= $candidate['photo_url'] ?>">
    </div>
<?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">📄 Резюме (PDF)</label>
                <input type="file" name="resume" class="form-control">

                <?php if(!empty($candidate['resume_pdf'])): ?>
    <div class="mt-2">
        <a href="/uploads/<?= $candidate['resume_pdf'] ?>" 
           target="_blank"
           class="btn btn-outline-secondary btn-sm">
            📄 Открыть текущее резюме
        </a>

        <input type="hidden" name="old_resume" value="<?= $candidate['resume_pdf'] ?>">
    </div>
<?php endif; ?>
            </div>

            <button class="btn btn-success w-100 py-2 fw-bold">
                💾 Сохранить
            </button>

        </form>

    </div>

</div>

</body>
</html>