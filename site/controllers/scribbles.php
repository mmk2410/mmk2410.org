<?php

use Kirby\Cms\Page;

return function (Page $page): array {
    $scribbles = $page->children()->listed();

    return [
        'scribbles' => $scribbles->flip()->paginate(20)
    ];
};
