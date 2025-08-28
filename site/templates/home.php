<?php
/**
 * @var Kirby\Cms\Site $site
 * @var Kirby\Cms\Page $page
 */
?>

<?php snippet('layout', slots: true) ?>
<?php slot() ?>
<header>
  <h1><?= $site->title() ?></h1>
  <h3><?= $page->subtitle() ?></h3>
</header>

<?= $page->text()->kirbytext() ?>

<h4>Read more from me</h4>

<?php foreach ($page->internal_menu()->toStructure() as $item): ?>
  <a class="btn" href="<?= $item->link()->toUrl() ?>"><?= $item->title() ?></a>
<?php endforeach ?>

<h4>Find me on other places</h4>

<?php foreach ($page->external_menu()->toStructure() as $item): ?>
  <a class="btn" href="<?= $item->link()->toUrl() ?>"><?= $item->title() ?></a>
<?php endforeach ?>

<h2>Newest scribbles</h2>

<p>My scribbles are my microblog. Random notes, mostly without any deeper meaning.</p>

<div>
  <?php
    page('scribbles')->children()->listed()->flip()->limit(3)->map(
      fn (ScribblePage $scribble) => snippet('scribble', ['scribble' => $scribble, 'singlePage' => false])
    )
  ?>
</div>

<div style="margin-top: 40px;">
  <a class="btn" href="<?= page('scribbles')->url() ?>">More mindless drivel</a>
</div>

<h2>Latest Posts</h2>

<?php foreach(page('blog')->children()->listed()->flip()->limit(3) as $article): ?>
  <?php snippet('article', ['article' => $article, 'main' => false]) ?>
<?php endforeach ?>

<a class="btn" href="<?= page('blog')->url() ?>">Read more posts</a>
<?php endslot() ?>
