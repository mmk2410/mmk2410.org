<?php
/**
 * @var Kirby\Cms\Kirby $kirby
 * @var Kirby\Cms\Site $site
 * @var Kirby\Cms\Page $page
 */

$kirby->response()->type('application/rss+xml');

$scribbles = $page
  ->children()
  ->template('scribble')
  ->listed()
  ->sortBy('date', 'desc')
  ->limit(25);

echo (new Mmk2410\KirbyHelpers\RssFeed($site, $scribbles, '/feed/scribbles'))->generate();
