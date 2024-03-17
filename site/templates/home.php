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

<h2>Latest Posts</h2>

<?php foreach(page('blog')->children()->listed()->flip()->limit(3) as $article): ?>
  <?php snippet('article', ['article' => $article]) ?>
<?php endforeach ?>

<a class="btn" href="<?= page('blog')->url() ?>">Read more posts</a>
<?php endslot() ?>
