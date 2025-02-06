<?php

use Kirby\Cms\App as Kirby;
use Kirby\Cms\Page;
use Kirby\Filesystem\F;
use Mmk2410\KirbyHelpers\Controller\ScribbleController;
use Mmk2410\KirbyHelpers\Helpers\Mastodon;

F::loadClasses([
    'Mmk2410\\KirbyHelpers\\Helpers\\Mastodon' => 'src/Helpers/Mastodon.php',
    'Mmk2410\\KirbyHelpers\\RssFeed' => 'src/RssFeed.php',
    'Mmk2410\\KirbyHelpers\\Middleware\\ApiAuthentication' => 'src/Middleware/ApiAuthentication.php',
    'Mmk2410\\KirbyHelpers\\Controller\\ScribbleController' => 'src/Controller/ScribbleController.php',
], __DIR__);

Kirby::plugin('mmk2410/kirby-helpers', [
    'routes' => [
        [
            'pattern' => 'my/api/v1/scribble',
            'action' => fn () => (new ScribbleController())->addScribble(),
            'method' => 'POST'
        ],
    ],
    'hooks' => [
        'page.changeStatus:after' => function (Page $newPage, Page $oldPage): void {
            $ignore = ($newPage->template()->name() !== 'scribble')
                || (!$newPage->isListed())
                || ($oldPage->status() === $newPage->status());
            if ($ignore) {
                return;
            }

            (new Mastodon())->post($newPage);
        }
    ],
]);
