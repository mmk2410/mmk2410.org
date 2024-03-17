<?php

$feed = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8" standalone="yes"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom"></rss>');

$feed->channel->title = $site->title()->toString();
$feed->channel->description = $site->description()->toString();
$feed->channel->link = url();
$feed->channel->language = 'en-us';
$feed->channel->lastBuildDate = date(DATE_RSS);
$feed->channel->generator = 'Kirby';

$atomLink = $feed->channel->addChild('atom:link', null, 'atom');
$atomLink->addAttribute('href', url('/feed'));
$atomLink->addAttribute('rel', 'self');
$atomLink->addAttribute('type', 'application/rss+xml');

$articles = $page->children()->template('article')->sortBy('date', 'desc')->limit(10);

foreach ($articles as $article) {
  $xmlArticle = $feed->channel->addChild('item');
  $xmlArticle->title = $article->title()->toString();
  $xmlArticle->link = url($article->url());
  $xmlArticle->description = Escape::xml($article->text()->kirbytext());
  $xmlArticle->pubDate = $article->date()->toDate(DATE_RSS);
  $xmlArticle->guid = url($article->url());
}

$kirby->response()->type('application/rss+xml');

echo $feed->asXML();
