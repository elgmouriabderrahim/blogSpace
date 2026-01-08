<aside class="w-72 bg-gray-900/80 backdrop-blur border-r border-gray-700 flex flex-col">

        <div class="px-6 py-6 text-xl font-bold text-white tracking-wide">
            Admin Dashboard
        </div>

        <nav class="flex-1 px-4 space-y-1 text-sm">

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

        </nav>

        <div class="p-4 border-t border-gray-700">
            <a href="/logout"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-red-400 hover:bg-red-500/10 hover:text-red-300 transition">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>
        </div>

    </aside>