<h1 class="text-3xl font-bold mb-6">Categories</h1>

<div class="bg-gray-800 p-6 rounded-xl border border-gray-700 mb-8 relative">
  <form method="post" action="/admin/categories/create" class="flex gap-4">
    <div class="flex-1">
      <input type="text" name="category_name" value="<?php if(isset($old_category_name)) echo $old_category_name ?>" class="w-full bg-gray-900 border border-gray-600 px-4 py-2 rounded" placeholder="Category name">
      <?php if (!empty($error)): ?>
        <div class="text-red-500 absolute bottom-0">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>
    </div>
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded">Add</button>
  </form>
</div>

<div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">

<?php if (!empty($categories)): ?>
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
      <td class="p-4"><?= (int)$category['id'] ?></td>
      <td class="p-4"><?= htmlspecialchars($category['name']) ?></td>
      <td class="p-4 text-right space-x-2">
        <form
          action="/admin/categories/delete"
          method="post"
          class="inline"
        >
          <input type="hidden" name="category_id" value="<?= (int)$category['id'] ?>">
          <button type="submit" class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-sm"
          >
            Delete
          </button>
        </form>

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
