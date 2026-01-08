<h1 class="text-3xl font-bold mb-6">Categories</h1>

<!-- Add category -->
<div class="bg-gray-800 p-6 rounded-xl border border-gray-700 mb-8">
  <form method="post" action="/admin/categories/create" class="flex gap-4">
    <input
      type="text"
      name="name"
      required
      class="flex-1 bg-gray-900 border border-gray-600 px-4 py-2 rounded"
      placeholder="Category name"
    >
    <button class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded">
      Add
    </button>
  </form>
</div>

<!-- Categories list -->
<div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">

<?php if (!empty($categories) && is_array($categories)): ?>

<table class="w-full">
  <thead class="bg-gray-900 text-gray-400">
    <tr>
      <th class="p-4 text-left">ID</th>
      <th class="p-4 text-left">Name</th>
      <th class="p-4 text-right">Actions</th>
    </tr>
  </thead>
  <tbody>

  <?php foreach ($categories as $category): ?>
    <tr class="border-t border-gray-700">
      <td class="p-4"><?= (int)($category['id'] ?? 0) ?></td>
      <td class="p-4">
        <?= htmlspecialchars($category['name'] ?? '—') ?>
      </td>
      <td class="p-4 text-right space-x-2">
        <a
          href="/admin/categories/edit/<?= (int)$category['id'] ?>"
          class="bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded text-sm"
        >
          Edit
        </a>
        <a
          href="/admin/categories/delete/<?= (int)$category['id'] ?>"
          class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-sm"
        >
          Delete
        </a>
      </td>
    </tr>
  <?php endforeach; ?>

  </tbody>
</table>

<?php else: ?>
  <div class="p-8 text-center text-gray-400">
    There are no categories yet.
  </div>
<?php endif; ?>

</div>
