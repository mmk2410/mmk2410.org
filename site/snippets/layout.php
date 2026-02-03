<?php
/**
 * @var Kirby\Cms\Site $site
 * @var Kirby\Cms\Page $page
 * @var string $slot
 */
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <title>
      <?= $site->title() ?>
      <?php if (!$page->isHomePage()): ?>
        - <?= $page->title() ?>
      <?php endif ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="<?= $site->author() ?>" />
    <?php $description = $page->description()->isNotEmpty() ? $page->description() : h($page->text()->excerpt(100)) ?>
    <meta name="description" content="<?= $description ?>" />
    <meta name="keywords" content="<?= $site->keywords() ?>" />

    <?= css('assets/build/main.css') ?>

    <link rel="canonical" href="<?= url($page->url()) ?>" />
    <link rel="alternate" type="application/rss+xml" href="<?= url('feed') ?>" title="<?= $site->title() ?>" />

    <link rel="apple-touch-icon-precomposed" sizes="256x256" href="/assets/img/favicon/favicon-256.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/img/favicon/favicon-144.png">
    <link rel="apple-touch-icon-precomposed" sizes="128x128" href="/assets/img/favicon/favicon-128.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/img/favicon/favicon-72.png">
    <link rel="apple-touch-icon-precomposed" href="/assets/img/favicon/favicon.png">
    <link rel="shortcut icon" href="/assets/img/favicon/favicon.png">

    <meta property="og:title" content="<?= $page->title() . ' - ' . $site->title() ?>" />
    <meta property="og:description" content="<?= $description ?>" />
    <meta property="og:type" content="<?= $page->template() == 'article' ? 'article' : 'website' ?>" />
    <meta property="og:url" content="<?= url($page->url()) ?>" />
    <meta property="og:image" content="<?= url('/assets/img/favicon/favicon-256.png') ?>" />
    <meta property="og:site_name" content="<?= $site->title() ?>" />
    <?php if ($page->template() == 'article'): ?>
      <meta property="og:article:publish_time" content="<?= $page->date()->toDate(DATE_ISO8601) ?>" />
      <meta property="og:article:author" content="<?= $site->author() ?>" />
      <meta property="og:article:section" content="<?= $page->categories() ?>" />
      <meta property="og:article:tag" content="<?= $page->tags() ?>" />
    <?php endif ?>

    <meta name="fediverse:creator" content="<?= $site->fediverseHandle() ?>" />
    <link rel="me" href="<?= $site->fediverseUrl() ?>">

    <script data-goatcounter="https://<?= option('analytics.goatcounter') ?>/count" async src="https://<?= option('analytics.goatcounter') ?>/count.js"></script>
  </head>
  <body>
    <header>
      <a id="title" href="/"><?= $site->title() ?></a>
      <label for="show-menu" class="show-menu">Menu</label>
      <input type="checkbox" id="show-menu" role="button">
      <nav>
	      <ul>
          <?php foreach ($site->menu()->toStructure() as $item): ?>
		        <li>
              <a href="<?= $item->link()->toUrl() ?>"><?= $item->title() ?></a>
            </li>
          <?php endforeach ?>
	      </ul>
      </nav>
    </header>
    <main>
      <?= $slot ?>
    </main>
    <footer>
      <p><?= date('Y') ?> © <?= $site->author() ?></p>
      <p>
        <?php foreach ($site->footerMenu()->toPages() as $item): ?>
          <a href="<?= $item->url() ?>"><?= $item->title() ?></a>
        <?php endforeach ?>
      </p>
    </footer>
  </body>
</html>
