<div class="w-[90%] lg:max-w-lg p-6 self-center">
    <h1 class="text-3xl font-bold mb-2 text-center">Welcome Back!</h1>
    <p class="text-gray-400 mb-6 text-center">Enter your credentials to access your blog Account</p>

    <form action="/login" method="post">
        <div class="relative mb-4">
            <label for="email">Email Address</label>
            <div class="relative">
                <i class="fa-solid fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email address"
                    value="<?= htmlspecialchars($inputData['email'] ?? '') ?>"
                    class="w-full pl-10 pr-3 py-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>
            <span class="text-red-500"><?= htmlspecialchars($errors['email'] ?? '') ?></span>
        </div>

        <div class="relative mb-4">
            <label for="password">Password</label>
            <div class="relative">
                <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input
                    type="password"
                    name="password"
                    value="<?= htmlspecialchars($inputData['password'] ?? '') ?>"
                    placeholder="Enter your password"
                    class="w-full pl-10 pr-3 py-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>
            <span class="text-red-500"><?= htmlspecialchars($errors['password'] ?? '') ?></span>
            <span class="text-red-500"><?= htmlspecialchars($errors['login'] ?? '') ?></span>
        </div>


        <button class="w-full py-3 bg-blue-600 rounded-lg font-semibold hover:bg-blue-700 transition cursor-pointer">
            Log In
        </button>
    </form>

    <p class="text-center text-gray-400 mt-6">
        Don't have an account? <a href="/register" class="text-blue-500 font-semibold">Register</a><br>
        <a href="/" class="mr-4 underline hover:text-blue-400">Return to home</a>
    </p>

    <img src="/assets/images/blog.png" alt="logo" class="mx-auto mt-4" />
</div>
