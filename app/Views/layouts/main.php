<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?= isset($title) ? htmlspecialchars($title) : 'Home' ?></title>
</head>
<body>
    <?php require __DIR__ . '/../partials/header.php'; ?>

    <main class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
        <?php require $viewFile; ?>
    </main>

    <?php require __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
