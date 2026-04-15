<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body class="bg-light d-flex align-items-center" style="min-height:100vh;">

<div class="container" style="max-width: 450px;">
    <div class="card shadow border-0">
        <div class="card-body p-4">

            <h3 class="text-center mb-4">🆕 Регистрация</h3>

            <?php if($error): ?>
                <div class="alert alert-danger"><?= h($error) ?></div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Введите email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Введите пароль</label>
                    <input type="password" name="password" class="form-control" required minlength="6">
                </div>

                <div class="mb-3">
                    <label class="form-label">Подтвердите пароль</label>
                    <input type="password" name="password_confirm" class="form-control" required>
                </div>

                <button class="btn btn-success w-100">Создать аккаунт</button>

            </form>

            <div class="mt-3 text-center">
                <a href="index.php?route=login">
                    Уже есть аккаунт? Войти
                </a>
            </div>

        </div>
    </div>
</div>

</body>
</html>