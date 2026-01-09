<h1 class="text-3xl font-bold mb-6">Edit Article</h1>

<div class="bg-gray-800 p-6 rounded-xl border border-gray-700">

<form method="post" action="/author/articles/update" class="space-y-5">

  <div>
    <label class="block mb-2 text-gray-400">Title</label>
    <input
      type="text"
      name="title"
      value="<?= htmlspecialchars($article['title']) ?>"
      class="w-full bg-gray-900 border border-gray-600 px-4 py-2 rounded"
    >
  </div>

  <div>
    <label class="block mb-2 text-gray-400">Content</label>
    <textarea
      name="content"
      rows="8"
      class="w-full bg-gray-900 border border-gray-600 px-4 py-2 rounded"
    ><?= htmlspecialchars($article['content']) ?></textarea>
  </div>

  <div>
    <label class="block mb-2 text-gray-400">Status</label>
    <select
      name="status"
      class="w-full bg-gray-900 border border-gray-600 px-4 py-2 rounded"
    >
      <option value="draft" <?= $article['status']==='draft'?'selected':'' ?>>Draft</option>
      <option value="published" <?= $article['status']==='published'?'selected':'' ?>>Published</option>
    </select>
  </div>

  <button
    type="submit"
    class="bg-green-600 hover:bg-green-700 px-6 py-2 rounded"
  >
    Update
  </button>

</form>

</div>
