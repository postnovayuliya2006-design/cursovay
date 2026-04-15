<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Заявки</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a href="index.php" class="navbar-brand">💼 Кадровое агентство</a>

        <a href="index.php?route=admin" class="btn btn-outline-light btn-sm">
            ← Панель администратора
        </a>
    </div>
</nav>

<div class="container">

    <h3 class="mb-4">📩 Заявки пользователей</h3>

    <table class="table table-bordered table-hover">

        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Кандидат</th>
                <th>Должность</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach($applications as $a): ?>

            <tr>

                <td><?= $a['application_id'] ?></td>
                <td><?= h($a['email']) ?></td>
                <td><?= h($a['full_name']) ?></td>
                <td><?= h($a['position']) ?></td>

                <td>
                    <?php if($a['status'] === 'approved'): ?>
                        <span class="badge bg-success">Принята</span>

                    <?php elseif($a['status'] === 'rejected'): ?>
                        <span class="badge bg-danger">Отклонена</span>

                    <?php else: ?>
                        <span class="badge bg-secondary">Отправлена</span>
                    <?php endif; ?>
                </td>

                <td class="d-flex gap-2">

                    <a href="index.php?route=update_application_status&id=<?= $a['application_id'] ?>&status=approved"
                       class="btn btn-success btn-sm">
                        ✔ Принять
                    </a>

                    <a href="index.php?route=update_application_status&id=<?= $a['application_id'] ?>&status=rejected"
                       class="btn btn-danger btn-sm">
                        ✖ Отклонить
                    </a>

                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

</body>
</html>