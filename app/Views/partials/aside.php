<aside class="w-72 bg-gray-900/80 backdrop-blur border-r border-gray-700 flex flex-col">

        <div class="px-6 py-6 text-xl font-bold text-white tracking-wide">
            <?php
                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Admin')
                    echo 'Admin Dashboard';
                elseif(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Author')
                    echo 'Admin Dashboard';
                else
                    echo'Blog Space';
            ?>
        </div>

        <nav class="flex-1 px-4 space-y-1 text-sm">
            <?php if(isset($_SESSION['user_id'])):?>
            <a href="/"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition">   
                <i class="fa-solid fa-house"></i>
                Home
            </a>
            <?php endif ?>
            <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Admin'):?>
            <a href="/admin/dashboard"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition">   
                <i class="fa-solid fa-chart-line"></i>
                Dashboard
            </a>

            <a href="/admin/users"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition">
                <i class="fa-solid fa-users"></i>
                Users
            </a>

            <a href="/admin/categories"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition">
                <i class="fa-solid fa-tags"></i>
                Categories
            </a>
            <?php endif ?>
            <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Author'):?>
            <a href="/author/dashboard"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition">
                <i class="fa-solid fa-chart-line"></i>
                Dashboard
            </a>
            <?php endif ?>
        </nav>

        <?php if(!isset($_SESSION['user_id'])):?>
        <div class="p-4 border-t border-gray-700">
            <a href="/login"
            class="flex items-center gap-3 px-4 py-3 rounded-lg text-green-400 bg-green-500/5 hover:bg-green-500/10 hover:text-green-300 transition-colors duration-200">
                <i class="fa-solid fa-right-to-bracket"></i>
                Login
            </a>
        </div>

        <div class="p-4">
            <a href="/register"
            class="flex items-center gap-3 px-4 py-3 rounded-lg text-blue-400  bg-blue-500/5 hover:bg-blue-500/10 hover:text-blue-300 transition-colors duration-200">
                <i class="fa-brands fa-uniregistry"></i>
                Register
            </a>
        </div>

        <?php endif ?>

        <?php if(isset($_SESSION['user_role'])):?>
        <div class="p-4 border-t border-gray-700">
            <a href="/logout"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-red-400 hover:bg-red-500/10 hover:text-red-300 transition">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>
        </div>
        <?php endif ?>

    </aside>