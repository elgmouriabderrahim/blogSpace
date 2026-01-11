<div class="w-[90%] lg:max-w-lg p-6">
    <h1 class="text-3xl font-bold mb-2 text-center">Create Account</h1>
    <p class="text-gray-400 mb-6 text-center">Join our community of readers and authors. Start sharing your stories today.</p>

    <form action="/register" method="post">
      <div class="relative mb-4">
        <label for="firstName">First Name</label>
        <div class="relative">
          <i class="fa-solid fa-address-card absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
          <input type="text" placeholder="First Name" name ="firstName" value="<?= htmlspecialchars($inputData['firstName'] ?? '') ?>" class="w-full pl-10 pr-3 py-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <span class="text-red-500 block mt-1 text-sm"><?= htmlspecialchars($errors['firstName'] ?? '') ?></span>
      </div>
      <div class="relative mb-4">
        <label for="lastName">Last Name</label>
        <div class="relative">
          <i class="fa-solid fa-address-card absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
          <input type="text" placeholder="Last Name" name="lastName" value="<?= htmlspecialchars($inputData['lastName'] ?? '') ?>" class="w-full pl-10 pr-3 py-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <span class="text-red-500 block mt-1 text-sm"><?= htmlspecialchars($errors['lastName'] ?? '') ?></span>
      </div>
      <div class="relative mb-4">
        <label for="userName">Username</label>
        <div class="relative">
          <i class="fa-solid fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
          <input type="text" placeholder="Username" name="userName" value="<?= htmlspecialchars($inputData['userName'] ?? '') ?>" class="w-full pl-10 pr-3 py-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">

        </div>
        <span class="text-red-500 block mt-1 text-sm"><?= htmlspecialchars($errors['userName'] ?? '') ?></span>
      </div>
  
      <div class="relative mb-4">
        <label for="email">Email</label>
        <div class="relative">
          <i class="fa-solid fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
          <input type="email" placeholder="Email Address" name="email" value="<?= htmlspecialchars($inputData['email'] ?? '') ?>" class="w-full pl-10 pr-3 py-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <span class="text-red-500 block mt-1 text-sm"><?= htmlspecialchars($errors['email'] ?? '') ?></span>
      </div>
  
      <div class="relative mb-4">
        <label for="password">Password</label>
        <div class="relative">
          <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
          <input type="password" name="password" value="<?= htmlspecialchars($inputData['password'] ?? '') ?>" placeholder="Enter a password" class="w-full pl-10 pr-3 py-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">

        </div>
        <span class="text-red-500 block mt-1 text-sm"><?= htmlspecialchars($errors['password'] ?? '') ?></span>
      </div>
  
      <div class="relative mb-4">
        <label for="cpassword">Confirm your password</label>
        <div class="relative">
          <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
          <input type="password" value="<?= htmlspecialchars($inputData['cpassword'] ?? '') ?>" placeholder="confirm your password" name="cpassword" class="w-full pl-10 pr-3 py-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <span class="text-red-500 block mt-1 text-sm"><?= htmlspecialchars($errors['cpassword'] ?? '') ?></span>
      </div>

  
      <button class="w-full py-3 bg-blue-600 rounded-lg font-semibold hover:bg-blue-700 transition cursor-pointer">Create Account</button>
    </form>

    <p class="text-center text-gray-400 mt-6">Already have an account? <a href="/login" class="text-blue-500 font-semibold">Log In</a><br><a href="/" class="mr-4 underline hover:text-blue-400">Return to home</a></p>
    <img src="/assets/images/blog.png" alt="logo">
  </div>