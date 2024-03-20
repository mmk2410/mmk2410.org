<article>
  <?php if ($main): ?>
  <h2><a href="<?= $article->url() ?>"><?= $article->title() ?></a></h2>
  <?php else: ?>
  <h3><a href="<?= $article->url() ?>"><?= $article->title() ?></a></h3>
  <?php endif ?>

  <p id="date"><?= $article->date()->toDate('Y-m-d') ?></p>
  <p>
    <div class="tagories">
      <?php if ($article->categories()->isNotEmpty()): ?>
      <span id="categories">
        <?php foreach ($article->categories()->split() as $category): ?>
          <a href="/blog/category/<?= $category ?>"><?= $category ?></a>
        <?php endforeach ?>
      </span>
      <?php endif ?>
      <?php if ($article->tags()->isNotEmpty()): ?>
      <span id="tags">
        <?php foreach ($article->tags()->split() as $tag): ?>
          <a href="/blog/tag/<?= $tag ?>"><?= $tag ?></a>
        <?php endforeach ?>
      </span>
      <?php endif ?>
    </div>
  </p>

  <p>
    <?= $article->text()->excerpt(300) ?>
  </p>

  <p><a href="<?= $article->url() ?>">Read more</a></p>
</article>
