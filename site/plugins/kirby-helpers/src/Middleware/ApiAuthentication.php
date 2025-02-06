<?php

namespace Mmk2410\KirbyHelpers\Middleware;

use Kirby\Exception\Exception;
use Kirby\Exception\PermissionException;

class ApiAuthentication
{
    public function auth(): void
    {
        $request = kirby()->request();
        $apiKeyHeader = $request->header('Api-Key');

        if ($apiKeyHeader === null) {
            throw new PermissionException();
        }

        $apiKey = $this->getApiKey();

        if ($apiKey !== $apiKeyHeader) {
            throw new PermissionException();
        }
    }

    private function getApiKey(): string
    {
        $apiKey = kirby()->option('mmk2410.kirby-helpers.api-key');

        if ($apiKey === null) {
            throw new Exception('No API key set!');
        }

        return $apiKey;
    }
}
