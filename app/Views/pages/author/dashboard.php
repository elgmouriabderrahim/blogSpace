<h1 class="text-3xl font-bold mb-6">My Articles</h1>

<a
  href="/author/articles/create"
  class="inline-block mb-6 bg-blue-600 hover:bg-blue-700 px-5 py-2 rounded"
>
  + New Article
</a>

<div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">


<?php if (!empty($articles)): ?>
<table class="w-full">
  <thead class="bg-gray-900 text-gray-400">
    <tr>
      <th class="p-4 text-left">Title</th>
      <th class="p-4 text-left">Status</th>
      <th class="p-4 text-left">Created</th>
      <th class="p-4 text-right">Actions</th>
    </tr>
  </thead>
  <tbody>

  <?php foreach ($articles as $article): ?>
    <tr class="border-t border-gray-700">
      <td class="p-4"><?= htmlspecialchars($article['title']) ?></td>
      <td class="p-4">
        <span class="<?= $article['status'] === 'published' ? 'text-green-400' : 'text-yellow-400' ?>">
          <?= ucfirst($article['status']) ?>
        </span>
      </td>
      <td class="p-4"><?= $article['created_at'] ?></td>
      <td class="p-4 text-right space-x-2">

        <a
          href="/author/articles/edit/<?= $article['id'] ?>"
          class="bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded text-sm"
        >
          Edit
        </a>

        <a
          href="/author/articles/delete/<?= $article['id'] ?>"
          class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-sm"
          onclick="return confirm('Delete this article?')"
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
    You haven’t written any articles yet.
  </div>
<?php endif; ?>

</div>
