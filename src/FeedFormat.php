<?php declare(strict_types=1);

namespace Lemonade\Feed;

enum FeedFormat: string
{
    case XML = 'xml';
    case JSON = 'json';

    public function isXml(): bool
    {
        return $this === self::XML;
    }

    public function isJson(): bool
    {
        return $this === self::JSON;
    }
}
