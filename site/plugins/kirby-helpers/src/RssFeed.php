<?php

namespace Mmk2410\KirbyHelpers;

use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Cms\Site;
use XMLWriter;

class RssFeed
{
    private XMLWriter $writer;

    private int $openElements = 0;

    public function __construct(
        private Site $site,
        private Pages $articles,
        private string $path
    ) {}

    public function generate(): string
    {
        $this->createWriter();
        $this->initialiseDocument();
        $this->writeMetadata();

        foreach ($this->articles as $article) {
            /** @var Kirby\Cms\Page $article */
            $this->writeArticle($article);
        }

        $this->finishDocument();

        return $this->writer->outputMemory();
    }

    private function createWriter(): void
    {
        $this->writer = new XMLWriter();
        $this->writer->openMemory();
        $this->writer->setIndent(true);
        $this->writer->setIndentString('  ');
    }

    private function initialiseDocument(): void
    {
        $this->writer->startDocument('1.0', 'UTF-8', 'yes');
        $this->writer->startElement('rss');
        $this->writer->writeAttribute('version', '2.0');
        $this->writer->writeAttributeNs('xmlns', 'atom', null, 'http://www.w3.org/2005/Atom');
    }

    private function writeMetadata(): void
    {
        $this->openElement('channel');
        $this->writer->writeElement('title', $this->title());
        $this->writer->writeElement('link', url());
        $this->writer->writeElement('description', $this->description());
        $this->writer->writeElement('language', 'en-GB');
        $this->writer->writeElement('lastBuildDate', $this->lastBuildDate());
        $this->writer->writeElement('generator', 'Kirby CMS');
        $this->writer->writeElement('docs', 'https://www.rssboard.org/rss-specification');

        $this->writeMetadataAuthor();
        $this->writeMetadataAtomLink();
        $this->writeMetadataImage();
    }

    private function writeMetadataAuthor(): void
    {
        $this->openElement('author');
        $this->writer->writeElement('name', $this->site->author()->toString());
        $this->writer->writeElement('uri', url('about'));
        $this->writer->writeElement('email', $this->site->authorEmail()->toString());
        $this->closeElement();
    }

    private function writeMetadataAtomLink(): void
    {
        $this->openElementNs('atom', 'link', null);
        $this->writer->writeAttribute('href', url($this->path));
        $this->writer->writeAttribute('rel', 'self');
        $this->writer->writeAttribute('type', 'application/rss+xml');
        $this->closeElement();
    }

    private function writeMetadataImage(): void
    {
        $this->openElement('image');
        $this->writer->writeElement('url', url('/assets/img/favicon/favicon.png'));
        $this->writer->writeElement('title', $this->title());
        $this->writer->writeElement('link', url());
        $this->closeElement();
    }

    private function writeArticle(Page $article): void
    {
        $this->openElement('item');

        $this->writer->writeElement('title', $article->title()->toString());
        $this->writer->writeElement('link', url($article->url()));
        $this->writer->writeElement('guid', url($article->url()));
        $this->writer->writeElement('pubDate', $article->date()->toDate(DATE_RSS));

        $this->openElement('description');
        $this->writer->writeCdata($article->text()->kirbytext()->toString());
        $this->closeElement(); // description

        $this->closeElement(); // item
    }

    private function finishDocument(): void
    {
        $this->closeRemainingElements();
        $this->writer->endDocument();
    }

    private function title(): string
    {
        return $this->site->title()->toString();
    }

    private function description(): string
    {
        return $this->site->description()->toString();
    }

    private function lastBuildDate(): string
    {
        return $this->articles->first()->date()->toDate(DATE_RSS);
    }

    private function openElement(string $name): void
    {
        $this->writer->startElement($name);
        $this->openElements++;
    }

    private function openElementNs(
        ?string $prefix,
        string $name,
        ?string $namespace
    ): void {
        $this->writer->startElementNs($prefix, $name, $namespace);
        $this->openElements++;
    }

    private function closeElement(): void
    {
        $this->writer->endElement();
        $this->openElements--;
    }

    private function closeRemainingElements(): void
    {
        while ($this->openElements > 0) {
            $this->closeElement();
        }
    }
}
