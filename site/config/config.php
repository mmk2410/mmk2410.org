<?php

return [
    'analytics' => [
        'goatcounter' => 'stats.mmk2410.org'
    ],
    'routes' => [
        [
            'pattern' => 'feed',
            'action' => fn () => go('/blog.rss')
        ],
        [
            'pattern' => 'feed/scribbles',
            'action' => fn () => go('/scribbles.rss')
        ],
        [
            'pattern' => 'index.xml',
            'action' => fn () => go('/blog.rss')
        ],
        [
            'pattern' => '(:num)/(:num)/(:num)/(:any)',
            'action' => function ($year, $month, $day, $slug) {
                $page = page('blog/' . $slug);
                if (!$page) return site()->errorPage();
                return site()->visit($page);
            }
        ],
        [
            'pattern' => 'blog/category/(:any)',
            'action' => function($category) {
                return page('blog')->render(['category' => $category]);
            }
        ],
        [
            'pattern' => 'blog/tag/(:any)',
            'action' => function($tag) {
                return page('blog')->render(['tag' => $tag]);
            }
        ],
        [
            'pattern' => 'scribbles/(:num)/(:num)/(:num)-(:num)',
            'action' => function ($year, $month, $day, $time) {
                $path = $year . $month . $day . '-' . $time;
                $page = page('scribbles/' . $path);
                if (!$page) return site()->errorPage();
                return site()->visit($page);
            }
        ],
    ],
    'bogdancondorachi.code-highlighter' => [
        'theme' => 'monokai',
    ],
];
