<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>💼 Кадровое агентство</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">💼 Кадровое агентство</a>

        <div class="ms-auto d-flex gap-2">

            <?php if(isset($_SESSION['user_id'])): ?>

                <?php if($_SESSION['role'] === 'admin'): ?>
                    <a href="index.php?route=admin" class="btn btn-warning btn-sm fw-bold">
                        🛠 Админ
                    </a>
                <?php endif; ?>

<?php if($_SESSION['role'] === 'client'): ?>
    <a href="index.php?route=profile" class="btn btn-outline-light btn-sm">
        👤 Профиль
    </a>
<?php endif; ?>

                <a href="index.php?route=logout" class="btn btn-danger btn-sm">
                    Выйти
                </a>

            <?php else: ?>

                <a href="index.php?route=login" class="btn btn-outline-light btn-sm">
                    Вход
                </a>

                <a href="index.php?route=register" class="btn btn-primary btn-sm">
                    Регистрация
                </a>

            <?php endif; ?>

        </div>
    </div>
</nav>

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h2 class="fw-bold">👨‍💼 Кандидаты</h2>

        <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="index.php?route=candidate_form" class="btn btn-success">
                + Добавить кандидата
            </a>
        <?php endif; ?>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

        <?php if (!empty($candidates)): ?>

            <?php foreach ($candidates as $c): ?>

                <div class="col">
                    <div class="card h-100 shadow-sm border-0">

<?php if(!empty($c['photo_url'])): ?>
    <img 
        src="/uploads/<?= h($c['photo_url']) ?>" 
        class="card-img-top"
        alt="Фото кандидата"
    >
<?php else: ?>
    <img 
        src="/img/no-photo.png" 
        class="card-img-top"
        alt="Нет фото"
    >
<?php endif; ?>

                        <div class="card-body d-flex flex-column">

                            <h5 class="fw-bold mb-1">
                                <?= h($c['full_name']) ?>
                            </h5>

                            <p class="text-muted mb-1">
                                <?= h($c['position']) ?>
                            </p>

                            <p class="text-success fw-bold mb-2">
                                💰 <?= h($c['expected_salary']) ?>
                            </p>

                            <!-- 📄 RESUME -->
<?php if(!empty($c['resume_pdf'])): ?>
    <a href="/uploads/<?= h($c['resume_pdf']) ?>" 
       target="_blank"
       class="btn btn-outline-secondary btn-sm mb-2">
        📄 Смотреть резюме
    </a>
<?php endif; ?>

                            <div class="mt-auto">

<?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'client'): ?>

    <?php if (!empty($appliedMap[$c['id']])): ?>

        <div class="alert alert-success text-center p-2 mb-2">
            ✔ Вы уже откликнулись
        </div>

        <a href="index.php?route=delete_application&id=<?= $appliedMap[$c['id']] ?>"
           class="btn btn-outline-danger w-100"
           onclick="return confirm('Удалить заявку?')">
            Удалить заявку
        </a>

    <?php else: ?>

        <a href="index.php?route=apply&id=<?= $c['id'] ?>"
           class="btn btn-success w-100">
            📩 Откликнуться
        </a>

    <?php endif; ?>

<?php endif; ?>

                                <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>

                                    <div class="d-flex gap-2 mt-2">

                                        <a href="index.php?route=candidate_form&id=<?= $c['id'] ?>" 
                                           class="btn btn-primary btn-sm w-50">
                                            ✏ Редактировать
                                        </a>

                                        <a href="index.php?route=delete_candidate&id=<?= $c['id'] ?>" 
                                           class="btn btn-danger btn-sm w-50"
                                           onclick="return confirm('Удалить кандидата?')">
                                            🗑 Удалить
                                        </a>

                                    </div>

                                <?php endif; ?>

                            </div>

                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="col-12 text-center py-5">
                <p class="text-muted">Кандидаты не найдены</p>
            </div>

        <?php endif; ?>

    </div>

    <?php if (!empty($totalPages) && $totalPages > 1): ?>
    <nav class="mt-4">
        <ul class="pagination justify-content-center">

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == ($page ?? 1)) ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?route=home&page=<?= $i ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>

        </ul>
    </nav>
    <?php endif; ?>

</div>

<footer class="bg-dark text-white text-center py-3 mt-5">
    <small>&copy; 2026 Кадровое агентство</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/js/script.js"></script>

</body>
</html>