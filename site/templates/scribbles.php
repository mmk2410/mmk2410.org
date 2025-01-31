<?php
/**
 * @var Kirby\Cms\Page $page
 * @var Kirby\Cms\Pages $scribbles
 */
?>

<?php snippet('layout', slots: true) ?>
<?php slot() ?>
<h1><?= $page->title() ?></h1>

<?= $page->text()->kirbytext() ?>

<?php foreach($scribbles as $scribble): ?>
  <?php snippet('scribble', ['scribble' => $scribble, 'singlePage' => false]) ?>
<?php endforeach ?>

<?php if ($scribbles->pagination()->hasPages()): ?>
  <nav class="pagination">
    <?php if ($scribbles->pagination()->hasNextPage()): ?>
      <a class="page-item next" href="<?= $scribbles->pagination()->nextPageURL() ?>">
        ‹ older scribbles
      </a>
    <?php endif ?>

    <?php if ($scribbles->pagination()->hasPrevPage()): ?>
      <a class="page-item prev" href="<?= $scribbles->pagination()->prevPageURL() ?>">
        newer scribbles ›
      </a>
    <?php endif ?>
  </nav>
<?php endif ?>

<?php endslot() ?>
