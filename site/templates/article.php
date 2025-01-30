<?php
/**
 * @var Kirby\Cms\Page $page
 */
?>

<?php snippet('layout', slots: true) ?>
<?php slot() ?>
<h1><?= $page->title() ?></h1>

<p id="date"><?= $page->date()->toDate('Y-m-d') ?></p>
<p id="readingtime"><?= $page->readingTime() ?></p>

<p>
  <div class="tagories">
    <?php if ($page->categories()->isNotEmpty()): ?>
      <span id="categories">
        <?php foreach ($page->categories()->split() as $category): ?>
          <a href="/blog/category/<?= $category ?>"><?= $category ?></a>
        <?php endforeach ?>
      </span>
    <?php endif ?>
    <?php if ($page->tags()->isNotEmpty()): ?>
      <span id="tags">
        <?php foreach ($page->tags()->split() as $tag): ?>
          <a href="/blog/tag/<?= $tag ?>"><?= $tag ?></a>
        <?php endforeach ?>
      </span>
    <?php endif ?>
  </div>
</p>

<?= $page->text()->kirbytext() ?>

<div class="comment">
  <p>I would like to hear what you think about this post. Feel free to write me a mail!</p>
  <a class="btn" href="mailto:comment@mmk2410.org?subject=Reply to: <?= $page->title()?>">Reply by mail</a>
</div>
<?php endslot() ?>
