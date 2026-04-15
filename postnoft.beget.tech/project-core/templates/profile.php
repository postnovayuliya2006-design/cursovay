<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4">👤 Профиль</h2>

    <div class="card p-3 mb-4">
        <p><strong>Email:</strong> <?= h($_SESSION['username']) ?></p>
        <p><strong>Роль:</strong> Клиент</p>

        <a href="index.php?route=logout" class="btn btn-danger mt-2">
            Выйти
        </a>
    </div>

    <h4 class="mb-3">📩 Мои заявки</h4>

    <?php if(!empty($userApplications)): ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Кандидат</th>
                    <th>Должность</th>
                    <th>Статус</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($userApplications as $app): ?>

                    <tr>
                        <td><?= h($app['full_name']) ?></td>
                        <td><?= h($app['position']) ?></td>
                        <td><?= h($app['status']) ?></td>
                        <td>
                            <a href="index.php?route=delete_application&id=<?= $app['id'] ?>"
                               class="btn btn-danger btn-sm">
                                Удалить
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>
        </table>

    <?php else: ?>

        <p class="text-muted">У вас пока нет заявок</p>

    <?php endif; ?>

</div>

</body>
</html>