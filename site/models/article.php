<?php

use Kirby\Cms\Page;

/**
 * @method object categories()
 * @method object tags()
 * @method object date()
 * @method object text()
 */
class ArticlePage extends Page
{
    private const READING_TIME_FORMAT = '%d words, ~%d min reading time';

    /**
     * @param array|string|null $options
     */
    public function url($options = null): string
    {
        $date = $this->date()->toDate('Y/m/d');
        return '/' . $date .'/' . $this->slug();
    }

    public function readingTime(): string
    {
        $doc = new DOMDocument();
        $doc->loadHTML(
            '<html><head><meta charset="UTF-8"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head><body>'
            . $this->text()->kirbytext()
            . '</body></html>'
        );
        $pElems = $doc->getElementsByTagName('p');

        $text = '';
        foreach ($pElems as $pElem) {
            $text .= $pElem->nodeValue . ' ';
        }

        $wordCount = count(explode(' ', $text));
        $readingTime = (int)ceil($wordCount / 150);

        return sprintf(self::READING_TIME_FORMAT, $wordCount, $readingTime);
    }
}
