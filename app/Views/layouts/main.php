<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Admin Dashboard' ?></title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>

<body class="bg-gradient-to-br from-gray-950 via-gray-900 to-gray-800 text-gray-200 min-h-screen">

<div class="flex min-h-screen">
    <?php
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if($uri !== '/login' && $uri !== '/register') require_once dirname(__DIR__) . "/partials/aside.php";
    ?>
    
    <main class="flex-1 flex flex-col">
        
        <?php require_once dirname(__DIR__) . "/partials/header.php"; ?>

        <section class="flex-1 p-10 <?=  ($uri === '/login' || $uri === '/register') ? 'self-center':'' ?>">
            <?php require $viewFile; ?>
        </section>

    </main>

</div>

</body>
</html>
