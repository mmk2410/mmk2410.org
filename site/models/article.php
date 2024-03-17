<?php

class ArticlePage extends Page
{
    public function url($options = null): string
    {
        $date = $this->date()->toDate('Y/m/d');
        return '/' . $date .'/' . $this->slug();
    }

    public function readingTime() {
        $doc = new DOMDocument();
        $doc->loadHtml(
            "<html><head><meta charset=\"UTF-8\"><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"></head><body>"
                . $this->text()->kirbytext()
                ."</body></html>"
        );
        $pElems = $doc->getElementsByTagName('p');

        $text = '';
        foreach ($pElems as $pElem) {
            $text .= $pElem->nodeValue . ' ';
        }

        $wordCount = count(explode(' ', $text));
        $readingTime = (int)ceil($wordCount / 150);

        return $wordCount . ' words, ~' . $readingTime . 'min reading time';
    }
}
