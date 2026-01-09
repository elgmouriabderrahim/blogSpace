<h1 class="text-4xl font-semibold mb-10 tracking-tight">
  Latest Articles
</h1>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

<?php foreach ($articles as $article): ?>
  <article class="bg-gray-900 border border-gray-800 rounded-2xl p-6
                  hover:border-gray-700 transition">

    <h2 class="text-2xl font-medium mb-2 leading-snug">
      <?= htmlspecialchars($article['title']) ?>
    </h2>

    <div class="flex items-center text-sm text-gray-400 mb-4 gap-4">
      <span>
        <i class="fa-regular fa-user mr-1"></i>
        <?= htmlspecialchars($article['author']) ?>
      </span>
      <span>
        <i class="fa-regular fa-calendar mr-1"></i>
        <?= htmlspecialchars($article['date']) ?>
      </span>
    </div>

    <p class="text-gray-300 leading-relaxed mb-6">
      <?= htmlspecialchars($article['excerpt']) ?>
    </p>

    <div class="flex items-center justify-between border-t border-gray-800 pt-4">

      <!-- Read more -->
      <a href="/articles/<?= $article['id'] ?>"
         class="text-blue-400 hover:text-blue-300 font-medium">
        Read article
      </a>

      <div class="flex items-center gap-6 text-gray-400">

        <span class="flex items-center gap-2">
          <i class="fa-regular fa-heart"></i>
          <?= (int)$article['likes'] ?>
        </span>

        <span class="flex items-center gap-2">
          <i class="fa-regular fa-comment"></i>
          <?= (int)$article['comments'] ?>
        </span>

        <?php if ($userRole === 'reader'): ?>
          <form method="post" action="/articles/like">
            <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
            <button
              class="text-gray-400 hover:text-red-500 transition"
              title="Like article"
            >
              <i class="fa-solid fa-heart"></i>
            </button>
          </form>
        <?php endif; ?>

      </div>

    </div>

  </article>
<?php endforeach; ?>

</div>
