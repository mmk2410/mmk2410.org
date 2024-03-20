<?php snippet('layout', slots: true) ?>
<?php slot() ?>
<h1><?= $page->title() ?></h1>

<?= $page->text()->kirbytext() ?>

<?php foreach($articles as $article): ?>
  <?php snippet('article', ['article' => $article, 'main' => true]) ?>
<?php endforeach ?>

<?php if ($articles->pagination()->hasPages()): ?>
  <nav class="pagination">
    <?php if ($articles->pagination()->hasNextPage()): ?>
      <a class="page-item next" href="<?= $articles->pagination()->nextPageURL() ?>">
        ‹ older posts
      </a>
    <?php endif ?>

    <?php if ($articles->pagination()->hasPrevPage()): ?>
      <a class="page-item prev" href="<?= $articles->pagination()->prevPageURL() ?>">
        newer posts ›
      </a>
    <?php endif ?>
  </nav>
<?php endif ?>

<?php endslot() ?>
