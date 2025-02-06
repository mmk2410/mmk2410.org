<?php

use Kirby\Cms\App as Kirby;
use Kirby\Filesystem\F;

F::loadClasses([
    'Mmk2410\\KirbyHelpers\\RssFeed' => 'src/RssFeed.php',
    'Mmk2410\\KirbyHelpers\\Middleware\\ApiAuthentication' => 'src/Middleware/ApiAuthentication.php',
    'Mmk2410\\KirbyHelpers\\Controller\\ScribbleController' => 'src/Controller/ScribbleController.php',
], __DIR__);

Kirby::plugin('mmk2410/kirby-helpers', [
    'routes' => [
        [
            'pattern' => 'my/api/v1/scribble',
            'action' => fn () => (new Mmk2410\KirbyHelpers\Controller\ScribbleController())->addScribble(),
            'method' => 'POST'
        ],
    ]
]);
