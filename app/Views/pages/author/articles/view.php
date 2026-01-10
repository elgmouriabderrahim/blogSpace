<h1 class="text-3xl font-bold mb-6">View Article</h1>

<div class="bg-gray-800 p-6 rounded-xl border border-gray-700">

  <div class="mb-5">
    <label class="block mb-2 text-gray-400">Title</label>
    <p class="w-full bg-gray-900 border border-gray-600 px-4 py-2 rounded"><?= htmlspecialchars($article->getTitle()) ?></p>
  </div>

  <div class="mb-5">
    <label class="block mb-2 text-gray-400">Content</label>
    <p class="w-full bg-gray-900 border border-gray-600 px-4 py-2 rounded whitespace-pre-wrap"><?= htmlspecialchars($article->getContent()) ?></p>
  </div>

  <div class="mb-5">
    <label class="block mb-2 text-gray-400">Status</label>
    <p class="w-full bg-gray-900 border border-gray-600 px-4 py-2 rounded"><?= htmlspecialchars($article->getStatus()) ?></p>
  </div>

  <div class="mb-5">
    <label class="block mb-2 text-gray-400">Created At</label>
    <p class="w-full bg-gray-900 border border-gray-600 px-4 py-2 rounded"><?= htmlspecialchars($article->getCreatedAt()) ?></p>
  </div>

</div>
