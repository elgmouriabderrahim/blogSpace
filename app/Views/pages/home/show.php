<h1 class="text-3xl font-bold mb-4">
  <?= htmlspecialchars($article['title']) ?>
</h1>

<p class="text-gray-400 mb-6">
  By <?= htmlspecialchars($article['author']) ?>
</p>

<div class="prose prose-invert mb-8">
  <?= nl2br(htmlspecialchars($article['content'])) ?>
</div>

<hr class="border-gray-700 mb-6">

<h2 class="text-xl font-semibold mb-4">Comments</h2>

<?php foreach ($comments as $comment): ?>
  <div class="bg-gray-800 p-4 rounded mb-3">
    <p class="text-sm text-gray-400">
      <?= htmlspecialchars($comment['user']) ?>
    </p>
    <p><?= htmlspecialchars($comment['content']) ?></p>
  </div>
<?php endforeach; ?>

<?php if ($userRole === 'reader'): ?>
  <form method="post" action="/articles/comment"
        class="bg-gray-800 p-4 rounded mt-6 space-y-3">

    <textarea name="comment"
              class="w-full bg-gray-900 border px-4 py-2 rounded"
              placeholder="Write your comment..."></textarea>

    <input type="hidden" name="article_id" value="<?= $article['id'] ?>">

    <button class="bg-green-600 px-4 py-2 rounded">
      Comment
    </button>
  </form>
<?php else: ?>
  <p class="text-gray-400 mt-4">
    Only readers can comment.
  </p>
<?php endif; ?>
