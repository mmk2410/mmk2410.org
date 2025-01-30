<?php

use Kirby\Cms\Page;

return function (Page $page, ?string $tag, ?string $category): array {
    $articles = $page->children()->listed();

    if ($tag) {
        $articles = $articles->filterBy('tags', $tag, ',');
    }

    if ($category) {
        $articles = $articles->filterBy('categories', $category, ',');
    }

    return [
        'articles' => $articles->flip()->paginate(20)
    ];
};
