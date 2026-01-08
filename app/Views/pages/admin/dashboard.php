<h1 class="text-3xl font-bold mb-2">
  Welcome back,
  <?= isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Admin' ?>
</h1>

<p class="text-gray-400 mb-8">
  Here’s what’s happening in your blog today.
</p>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

  <div class="bg-gray-800 p-6 rounded-xl border border-gray-700">
    <p class="text-gray-400">Users</p>
    <p class="text-3xl font-bold">
      <?= isset($stats['users']) ? (int)$stats['users'] : 0 ?>
    </p>
  </div>

  <div class="bg-gray-800 p-6 rounded-xl border border-gray-700">
    <p class="text-gray-400">Articles</p>
    <p class="text-3xl font-bold">
      <?= isset($stats['articles']) ? (int)$stats['articles'] : 0 ?>
    </p>
  </div>

  <div class="bg-gray-800 p-6 rounded-xl border border-gray-700">
    <p class="text-gray-400">Categories</p>
    <p class="text-3xl font-bold">
      <?= isset($stats['categories']) ? (int)$stats['categories'] : 0 ?>
    </p>
  </div>

  <div class="bg-gray-800 p-6 rounded-xl border border-gray-700">
    <p class="text-gray-400">Pending Users</p>
    <p class="text-3xl font-bold text-orange-400">
      <?= isset($stats['pending_users']) ? (int)$stats['pending_users'] : 0 ?>
    </p>
  </div>

</div>

<!-- Recent activity -->
<div class="bg-gray-800 p-6 rounded-xl border border-gray-700">
  <h2 class="text-xl font-semibold mb-4">Recent Activity</h2>

  <?php if (!empty($activities) && is_array($activities)): ?>
    <ul class="space-y-3">
      <?php foreach ($activities as $activity): ?>
        <li class="flex justify-between">
          <span><?= htmlspecialchars($activity['message'] ?? 'Activity') ?></span>
          <span class="text-gray-400">
            <?= htmlspecialchars($activity['time'] ?? '') ?>
          </span>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p class="text-gray-400">No recent activity.</p>
  <?php endif; ?>
</div>
