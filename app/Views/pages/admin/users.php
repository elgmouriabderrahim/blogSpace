<h1 class="text-3xl font-bold mb-6">Users</h1>

<div class="bg-gray-800 rounded-xl overflow-hidden border border-gray-700">

<?php if (!empty($users) && is_array($users)): ?>

<table class="w-full">
  <thead class="bg-gray-900 text-gray-400">
    <tr>
      <th class="p-4 text-left">ID</th>
      <th class="p-4 text-left">Full Name</th>
      <th class="p-4 text-left">Username</th>
      <th class="p-4 text-left">Email</th>
      <th class="p-4 text-left">Role</th>
      <th class="p-4 text-left">Status</th>
      <th class="p-4 text-right">Actions</th>
    </tr>
  </thead>

  <tbody>
  <?php foreach ($users as $user): ?>

    <?php
      $id        = (int)($user['id'] ?? 0);
      $firstName = $user['firstName'] ?? '';
      $lastName  = $user['lastName'] ?? '';
      $username  = $user['userName'] ?? '';
      $email     = $user['email'] ?? '';
      $role      = $user['role'] ?? 'Reader';
      $isBanned  = ($user['is_banned'] ?? '0') === '1';
      $canBan    = ($role === 'Reader');
    ?>

    <tr class="border-t border-gray-700 hover:bg-gray-900/40 transition">
      <td class="p-4"><?= $id ?></td>

      <td class="p-4">
        <?= htmlspecialchars(trim("$firstName $lastName") ?: '—') ?>
      </td>

      <td class="p-4">
        <?= htmlspecialchars($username) ?>
      </td>

      <td class="p-4">
        <?= htmlspecialchars($email) ?>
      </td>

      <td class="p-4">
        <?php if ($role === 'Admin'): ?>
          <span class="text-purple-400 font-semibold">Admin</span>
        <?php elseif ($role === 'Author'): ?>
          <span class="text-blue-400">Author</span>
        <?php else: ?>
          <span class="text-gray-300">Reader</span>
        <?php endif; ?>
      </td>

      <td class="p-4">
        <?php if ($isBanned): ?>
          <span class="text-red-400">Banned</span>
        <?php else: ?>
          <span class="text-green-400">Active</span>
        <?php endif; ?>
      </td>

      <td class="p-4 text-right">
        <?php if ($canBan): ?>
          <?php if (!$isBanned): ?>
            <form action="/admin/users/ban" method="post">
              <input type="hidden" name="user_id" value="<?= $id ?>">
              <button type="submit" class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-sm">
                Ban
              </button>
            </form>
          <?php else: ?>
            <form action="/admin/users/unban" method="post">
              <input type="hidden" name="user_id" value="<?= $id ?>">
              <button type="submit" class="bg-green-600 hover:bg-green-700 px-3 py-1 rounded text-sm">
                Unban
              </button>
            </form>
          <?php endif; ?>
        <?php else: ?>
          <span class="text-gray-600 text-sm">Protected</span>
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
