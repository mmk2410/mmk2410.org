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

    private const WORDS_PER_MINUTE = 150;

    /**
     * @param array|string|null $options
     */
    public function url($options = null): string
    {
        $date = $this->date()->toDate('Y/m/d');
        return '/' . $date .'/' . $this->slug();
    }

    /**
     * Simple function for estimating the reading time of the article.
     *
     * The  algorithm counts  all  words  in p-Elements  and  divides them  by
     * words-per-minute amount  defined in  WORDS_PER_MINUTES. It  outputs the
     * text defined in READING_TIME_FORMAT containing the estimated word count
     * and estimated reading time.
     *
     * @return string Text with estimated reading time.
     */
    public function readingTime(): string
    {
        // After  requiring  PHP  8.4  or  higher,  replace  DOMDocument  with
        // DOM/HTMLDocument and remove the  LIBXML_NOERROR option. This option
        // is  only  needed  because   DOMDocument  only  supports  HTML4  and
        // therefore throws warnings for HTML5 tags.
        $doc = new DOMDocument();
        $doc->loadHTML(
            '<html><head><meta charset="UTF-8"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head><body>'
                . $this->text()->kirbytext()
                . '</body></html>',
            LIBXML_NOERROR
        );
        $pElems = $doc->getElementsByTagName('p');

        $text = '';
        foreach ($pElems as $pElem) {
            $text .= $pElem->nodeValue . ' ';
        }

        $wordCount = count(explode(' ', $text));
        $readingTime = (int)ceil($wordCount / self::WORDS_PER_MINUTE);

        return sprintf(self::READING_TIME_FORMAT, $wordCount, $readingTime);
    }
}
