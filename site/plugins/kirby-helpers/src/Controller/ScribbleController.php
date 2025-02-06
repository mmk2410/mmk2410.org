<?php

namespace Mmk2410\KirbyHelpers\Controller;

use DateTimeImmutable;
use Kirby\Cms\Page;
use Kirby\Cms\Response;
use Kirby\Exception\BadMethodCallException;
use Mmk2410\KirbyHelpers\Middleware\ApiAuthentication;

class ScribbleController
{
    private const SCRIBBLES_PAGE = 'scribbles';

    private const SCRIBBLE_TEMPLATE = 'scribble';

    private const STATUS_LISTED = 'listed';

    private const SLUG_DATE_FORMAT = 'Ymd-Hi';

    private const TITLE_DATE_FORMAT = 'Y-m-d H:i';

    private const NUM_DATE_FORMAT = 'YmdHi';

    private const CONTENT_DATE_FORMAT = 'Y-m-d H:i';

    public function addScribble(): Response
    {
        (new ApiAuthentication())->auth();

        $text = kirby()->request()->body()->get('text');

        if ($text === null) {
            throw new BadMethodCallException('Invalid request');
        }

        $date = new DateTimeImmutable();
        $num = (int) $date->format(self::NUM_DATE_FORMAT);

        kirby()->impersonate('kirby');
        $page = Page::create([
            'parent' => page(self::SCRIBBLES_PAGE),
            'slug' => $date->format(self::SLUG_DATE_FORMAT),
            'draft' => false,
            'template' => self::SCRIBBLE_TEMPLATE,
            'content' => [
                'title' => $date->format(self::TITLE_DATE_FORMAT),
                'text' => $text,
                'date' => $date->format(self::CONTENT_DATE_FORMAT),
            ],
        ]);
        $page->changeStatus(self::STATUS_LISTED, $num);
        kirby()->impersonate('nobody');

        return new Response(code: 200);
    }
}
