<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Home' ?></title>
</head>
<body>

    <?php require __DIR__ . '/../partials/header.php'; ?>

    <main>
        <?php require $viewFile; ?>
    </main>

    <?php require __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
