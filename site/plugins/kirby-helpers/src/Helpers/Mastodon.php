<?php

namespace Mmk2410\KirbyHelpers\Helpers;

use Kirby\Cms\Page;

class Mastodon
{
    private const DEFAULT_VISIBILITY = 'public';

    public function post(Page $page): void
    {
        $statusText = $page->content()->get('text');
        $this->postStatus($statusText);
    }

    private function postStatus(
        string $status,
        string $visibility = self::DEFAULT_VISIBILITY
    ): void
    {
        $apiUrl = 'https://'
            . kirby()->option('mmk2410.kirby-helpers.mastodon-domain')
            . '/api/v1/statuses';

        $apiToken = kirby()->option('mmk2410.kirby-helpers.mastodon-token');

        $body = json_encode([
            'status' => $status,
            'visibility'=> $visibility
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $apiToken",
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }
}
