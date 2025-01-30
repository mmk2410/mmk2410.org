<?php

use Kirby\Cms\Page;

return function (Page $page): array {
    return [
        'quotes' => $page->children()->listed()->flip()->paginate(20)
    ];
};
