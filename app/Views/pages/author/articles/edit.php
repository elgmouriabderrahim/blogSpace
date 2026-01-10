<h1 class="text-3xl font-bold mb-6">Edit Article</h1>

<div class="bg-gray-800 p-6 rounded-xl border border-gray-700">

<form method="post" action="/author/articles/edit" class="space-y-5">
  <input type="hidden" name="article_id" value="<?= $old['id'] ?? '' ?>">

  <div>
    <label class="block mb-2 text-gray-400">Title</label>
    <input
      type="text"
      name="title"
      value="<?= $old['title'] ?>"
      class="w-full bg-gray-900 border border-gray-600 px-4 py-2 rounded"
      placeholder="Article title"
    >
    <?php if (isset($errors['title'])): ?>
        <div class="text-red-500 bottom-0">
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
      placeholder="Write your article..."><?= $old['content']?>"</textarea>
    <?php if (isset($errors['content'])): ?>
        <div class="text-red-500 bottom-0">
          <?= htmlspecialchars($errors['content']) ?>
        </div>
    <?php endif; ?>
  </div>

  <div>
    <label class="block mb-2 text-gray-400">Status</label>
    <select name="status" class="w-full bg-gray-900 border border-gray-600 px-4 py-2 rounded">
      <option value="Draft" <?php if($old['status'] === 'draft')  echo 'selected' ?>>Draft</option>
      <option value="Published" <?php if($old['status'] === 'published') echo 'selected' ?>>Published</option>
    </select>
    <?php if (isset($errors['status'])): ?>
        <div class="text-red-500 bottom-0">
          <?= htmlspecialchars($errors['status']) ?>
        </div>
    <?php endif; ?>
  </div>

  <button
    type="submit"
    class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded"
  >
    Save Changes
  </button>

</form>
</div>
