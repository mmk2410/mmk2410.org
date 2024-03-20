<?php

$kirby->response()->type('application/rss+xml');

$articles = $page
  ->children()
  ->template('article')
  ->listed()
  ->sortBy('date', 'desc')
  ->limit(10);

$writer = new XMLWriter();
$writer->openMemory();
$writer->setIndent(true);
$writer->setIndentString('  ');

$writer->startDocument('1.0', 'UTF-8', 'yes');

$writer->startElement('rss');
$writer->writeAttribute('version', '2.0');
$writer->writeAttributeNs('xmlns', 'atom', null, 'http://www.w3.org/2005/Atom');

$writer->startElement('channel');
$writer->writeElement('title', $site->title()->toString());
$writer->writeElement('link', url());
$writer->writeElement('description', $site->description()->toString());
$writer->writeElement('language', 'en-GB');
$writer->writeElement(
  'lastBuildDate',
  $articles->first()->date()->toDate(DATE_RSS)
);
$writer->writeElement('generator', 'Kirby CMS');
$writer->writeElement('docs', 'https://www.rssboard.org/rss-specification');

$writer->startElementNs('atom', 'link', null);
$writer->writeAttribute('href', url('/feed'));
$writer->writeAttribute('rel', 'self');
$writer->writeAttribute('type', 'application/rss+xml');
$writer->endElement(); // atom:link

$writer->startElement('image');
$writer->writeElement('url', url('/assets/img/favicon/favicon.png'));
$writer->writeElement('title', $site->title()->toString());
$writer->writeElement('link', url());
$writer->endElement(); // image

foreach ($articles as $article) {
  $writer->startElement('item');

  $writer->writeElement('title', $article->title()->toString());
  $writer->writeElement('link', url($article->url()));
  $writer->writeElement('guid', url($article->url()));
  $writer->writeElement('pubDate', $article->date()->toDate(DATE_RSS));

  $writer->startElement('description');
  $writer->writeCdata($article->text()->kirbytext()->toString());
  $writer->endElement(); // description

  $writer->endElement(); // item
}

$writer->endElement(); // channel
$writer->endElement(); // rss

$writer->endDocument();
echo $writer->outputMemory();
