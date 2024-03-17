<?php

return function ($page) {
    return [
        'quotes' => $page->children()->listed()->flip()->paginate(20)
    ];
};
