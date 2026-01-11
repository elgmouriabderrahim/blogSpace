<h1 class="text-4xl font-semibold mb-10 tracking-tight text-center">Welcome to Blog Space</h1>
<p class=" font-semibold mb-10 tracking-tight text-center">read the latest articles</p>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

<?php foreach ($articles as $article): ?>
  <article class="bg-gray-900 border border-gray-800 rounded-2xl p-6 hover:border-gray-700 transition">

    <h2 class="text-2xl font-medium mb-2 leading-snug">
      <?= htmlspecialchars($article->getTitle()) ?>
    </h2>

    <div class="flex items-center text-sm text-gray-400 mb-4 gap-4">
      <span>
        <i class="fa-regular fa-user mr-1"></i>
        <?= htmlspecialchars($article->getAuthorName()) ?>
      </span>
      <span>
        <i class="fa-regular fa-calendar mr-1"></i>
        <?= htmlspecialchars($article->getCreatedAt()) ?> 
      </span>
    </div>

    <div class="flex items-center justify-between border-t border-gray-800 pt-4">

      <form method="post" action="/articles/show">
        <input type="hidden" name="article_id" value="<?= $article->getId() ?>">
        <button type="submit" class="text-green-100 border border-neutral-500 px-2 py-1 rounded  rounded-md hover:bg-neutral-800 font-medium">
          Read Article
        </button>
      </form>

      <div class="flex items-center gap-6 text-gray-400">

        <span class="flex items-center gap-2">
          <i class="fa-regular fa-comment"></i>
          <?= $article->getCommentsCount() ?>
        </span>

        <?php if ($userRole === 'Reader'): ?>
          <form method="post" action="/reader/articles/like">
            <input type="hidden" name="article_id" value="<?= $article->getId() ?>">
            <input type="hidden" name="liked_by_reader" value="<?= $article->isLikedByReader() ?>">
            <input type="hidden" name="previous" value="/">
            <div class=" flex items-center gap-2">
              <button type="submit" class="<?= $article->isLikedByReader() ? 'text-red-500' : 'text-gray-400 hover:text-red-500' ?>">
                <i class="fa-solid fa-heart"></i>
              </button>
              <?= $article->getLikesCount() ?>
            </div>
          </form>
        <?php else: ?>
          <div class=" flex items-center gap-2">
              <i class="fa-solid fa-heart text-gray-400"></i>
            <?= $article->getLikesCount() ?>
          </div>
        <?php endif; ?>

      </div>

    </div>

  </article>
<?php endforeach; ?>

</div>
