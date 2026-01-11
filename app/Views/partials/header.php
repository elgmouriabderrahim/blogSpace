<header class="h-16 flex items-center justify-between px-8 border-b border-gray-700 bg-gray-900/60 backdrop-blur">  

    <div class="text-lg font-semibold">
        <?= isset($title) ? htmlspecialchars($title) : 'Home' ?>
    </div>

    <div class="flex items-center gap-4 text-sm text-gray-300">
        <i class="fa-solid fa-user-shield"></i>
        <?= htmlspecialchars($_SESSION['user_firstName'] . ' ' . $_SESSION['user_lastName'] ?? 'Guest') ?>
    </div>

</header>