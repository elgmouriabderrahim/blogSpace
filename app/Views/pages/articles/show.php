<h1 class="text-3xl font-bold mb-6"><?= htmlspecialchars($article->getTitle()) ?></h1>

<div class="bg-gray-800 p-6 rounded-xl border border-gray-700">

  <div class="text-gray-400 mb-6">
    <span><i class="fa-regular fa-user mr-1"></i><?= htmlspecialchars($article->getAuthorName()) ?></span>
    <span class="ml-4"><i class="fa-regular fa-calendar mr-1"></i><?= htmlspecialchars($article->getCreatedAt()) ?></span>
  </div>

  <div class="prose prose-invert mb-6"><?= nl2br(htmlspecialchars($article->getContent())) ?></div>

  <div class="flex items-center gap-6 mb-6">
    <form method="post" action="/reader/articles/like" class="flex items-center gap-2">
      <input type="hidden" name="article_id" value="<?= $article->getId() ?>">
      <input type="hidden" name="liked_by_reader" value="<?= $article->isLikedByReader() ?>">
      <input type="hidden" name="previous" value="/articles/show">
      <button type="submit" class="<?= $article->isLikedByReader() ? 'text-red-500' : 'text-gray-400 hover:text-red-500' ?> transition flex items-center gap-2">
        <i class="fa-solid fa-heart"></i>
      </button>
      <?= $article->getLikesCount() ?>
    </form>

    <span class="flex items-center gap-2 text-gray-400">
      <i class="fa-regular fa-comment"></i> <?= $article->getCommentsCount() ?>
    </span>
  </div>

  <div class="border-t border-gray-700 pt-6">
    <h2 class="text-xl font-semibold mb-4">Comments</h2>

    <?php if(!empty($comments)): ?>
      <?php foreach($comments as $comment): ?>
        <div class="mb-4 p-4 bg-gray-900 rounded-lg">
          <p class="text-gray-300 mb-1">
            <strong><?= htmlspecialchars($comment->getReaderName()) ?></strong>
            <span class="text-gray-400 text-sm"><?= htmlspecialchars($comment->getCreatedAt()) ?></span>
          </p>
          <p class="text-gray-200"><?= nl2br(htmlspecialchars($comment->getContent())) ?></p>

          <div class="flex items-center gap-2 mt-2">
            <form method="post" action="/reader/comments/like">
              <input type="hidden" name="article_id" value="<?= $article->getId() ?>">
              <input type="hidden" name="comment_id" value="<?= $comment->getId() ?>">
              <input type="hidden" name="liked_by_reader" value="<?= $comment->isLikedByReader() ?>">
              <button class="<?= $comment->isLikedByReader() ? 'text-red-500' : 'text-gray-400 hover:text-red-500' ?>">
                <i class="fa-solid fa-heart"></i>
              </button>
              <?= $comment->getLikesCount() ?>
            </form>

            <?php if ($_SESSION['user_id'] === $comment->getReaderId()): ?>
              <form method="post" action="/reader/comments/delete">
                <input type="hidden" name="article_id" value="<?= $article->getId() ?>">
                <input type="hidden" name="comment_id" value="<?= $comment->getId() ?>">
                <button class="text-red-400 text-sm">Delete</button>
              </form>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-gray-400 mb-4">No comments yet.</p>
    <?php endif; ?>

    <form method="post" action="/reader/articles/comment" class="space-y-4 mt-4">
      <input type="hidden" name="article_id" value="<?= $article->getId() ?>">
      <textarea name="content" rows="4" class="w-full bg-gray-900 border border-gray-600 px-4 py-2 rounded" placeholder="Add a comment..."><?= $old['content'] ?? '' ?></textarea>
      <?php if(isset($errors['content'])): ?>
        <p class="text-red-500 w-full transform -translate-y-1/2"><?= htmlspecialchars($errors['content']) ?></p>
      <?php endif; ?>
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded">Post Comment</button>
    </form>
  </div>
</div>
