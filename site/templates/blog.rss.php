<?php
/**
 * @var Kirby\Cms\Kirby $kirby
 * @var Kirby\Cms\Site $site
 * @var Kirby\Cms\Page $page
 */

$kirby->response()->type('application/rss+xml');

$articles = $page
  ->children()
  ->template('article')
  ->listed()
  ->sortBy('date', 'desc')
  ->limit(10);

echo (new Mmk2410\KirbyHelpers\RssFeed($site, $articles, '/feed'))->generate();
