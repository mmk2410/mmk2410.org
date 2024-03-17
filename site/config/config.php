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
        ]
    ]
];
