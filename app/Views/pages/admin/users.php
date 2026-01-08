<h1 class="text-3xl font-bold mb-6">Users</h1>

<div class="bg-gray-800 rounded-xl overflow-hidden border border-gray-700">

  <?php if (!empty($users) && is_array($users)): ?>

  <table class="w-full">
    <thead class="bg-gray-900 text-gray-400">
      <tr>
        <th class="p-4 text-left">ID</th>
        <th class="p-4 text-left">Username</th>
        <th class="p-4 text-left">Email</th>
        <th class="p-4 text-left">Role</th>
        <th class="p-4 text-left">Status</th>
        <th class="p-4 text-right">Actions</th>
      </tr>
    </thead>
    <tbody>

    <?php foreach ($users as $user): ?>
      <tr class="border-t border-gray-700">
        <td class="p-4"><?= (int)($user['id'] ?? 0) ?></td>

        <td class="p-4">
          <?= htmlspecialchars($user['userName'] ?? '—') ?>
        </td>

        <td class="p-4">
          <?= htmlspecialchars($user['email'] ?? '—') ?>
        </td>

        <td class="p-4">
          <?= htmlspecialchars($user['role'] ?? 'user') ?>
        </td>

        <td class="p-4">
          <?php if (!empty($user['banned'])): ?>
            <span class="text-red-400">Banned</span>
          <?php else: ?>
            <span class="text-green-400">Active</span>
          <?php endif; ?>
        </td>

        <td class="p-4 text-right">
          <?php if (empty($user['banned'])): ?>
            <a
              href="/admin/users/ban/<?= (int)$user['id'] ?>"
              class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-sm"
            >
              Ban
            </a>
          <?php else: ?>
            <span class="text-gray-500 text-sm">—</span>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>

    </tbody>
  </table>

  <?php else: ?>
    <div class="p-8 text-center text-gray-400">
      There are no users yet.
    </div>
  <?php endif; ?>

</div>
