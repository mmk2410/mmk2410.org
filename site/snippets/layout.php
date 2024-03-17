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
    <meta name="description" content="<?= $site->description() ?>" />
    <meta name="keywords" content="<?= $site->keywords() ?>" />

    <?= css('assets/build/main.css') ?>

    <link rel="alternate" type="application/rss+xml" href="<?= url('feed') ?>" title="<?= $site->title() ?>" />

    <link rel="apple-touch-icon-precomposed" sizes="256x256" href="/assets/img/favicon/favicon-256.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/img/favicon/favicon-144.png">
    <link rel="apple-touch-icon-precomposed" sizes="128x128" href="/assets/img/favicon/favicon-128.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/img/favicon/favicon-72.png">
    <link rel="apple-touch-icon-precomposed" href="/assets/img/favicon/favicon.png">
    <link rel="shortcut icon" href="/assets/img/favicon/favicon.png">

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
        <a href="<?= page('imprint')->url() ?>">Impressum und Datenschutz</a>
      </p>
    </footer>
  </body>
</html>
