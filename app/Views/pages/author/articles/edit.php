<h1 class="text-3xl font-bold mb-6">Edit Article</h1>

<div class="bg-gray-800 p-6 rounded-xl border border-gray-700">

<form method="post" action="/author/articles/edit" class="space-y-5">

  <input type="hidden" name="article_id" value="<?= $old['id'] ?? '' ?>">

  <div>
    <label class="block mb-2 text-gray-400">Title</label>
    <input
      type="text"
      name="title"
      value="<?= htmlspecialchars($old['title'] ?? '') ?>"
      class="w-full bg-gray-900 border border-gray-600 px-4 py-2 rounded"
      placeholder="Article title"
    >
    <?php if (isset($errors['title'])): ?>
      <div class="text-red-500">
        <?= htmlspecialchars($errors['title']) ?>
      </div>
    <?php endif; ?>
  </div>

  <div>
    <label class="block mb-2 text-gray-400">Content</label>
    <textarea
      name="content"
      rows="8"
      class="w-full bg-gray-900 border border-gray-600 px-4 py-2 rounded"
      placeholder="Write your article..."><?= htmlspecialchars($old['content'] ?? '') ?></textarea>
    <?php if (isset($errors['content'])): ?>
      <div class="text-red-500">
        <?= htmlspecialchars($errors['content']) ?>
      </div>
    <?php endif; ?>
  </div>

  <div>
    <label class="block mb-2 text-gray-400">Categories</label>
    <div class="grid grid-cols-2 gap-3">
      <?php foreach ($categories as $category): ?>
        <label class="flex items-center gap-2 text-gray-300">
          <input
            type="checkbox"
            name="categories[]"
            value="<?= $category->getId() ?>"
            class="accent-blue-600"
            <?= in_array($category->getId(), $old['categories'] ?? []) ? 'checked' : '' ?>
          >
          <?= htmlspecialchars($category->getName()) ?>
        </label>
      <?php endforeach; ?>
    </div>
    <?php if (isset($errors['categories'])): ?>
      <div class="text-red-500 mt-2">
        <?= htmlspecialchars($errors['categories']) ?>
      </div>
    <?php endif; ?>
  </div>

  <div>
    <label class="block mb-2 text-gray-400">Status</label>
    <select name="status" class="w-full bg-gray-900 border border-gray-600 px-4 py-2 rounded">
      <option value="Draft" <?= (($old['status'] ?? '') === 'draft') ? 'selected' : '' ?>>Draft</option>
      <option value="Published" <?= (($old['status'] ?? '') === 'published') ? 'selected' : '' ?>>Published</option>
    </select>
    <?php if (isset($errors['status'])): ?>
      <div class="text-red-500">
        <?= htmlspecialchars($errors['status']) ?>
      </div>
    <?php endif; ?>
  </div>

  <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded">
    Save Changes
  </button>

</form>
</div>
