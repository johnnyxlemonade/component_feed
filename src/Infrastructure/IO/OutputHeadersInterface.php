<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\IO;

use Lemonade\Feed\FeedFormat;

interface OutputHeadersInterface
{
    public function pushXmlHeaders(): void;
    public function pushJsonHeaders(): void;

    /**
     * @param array<string,string> $headers
     */
    public function pushCustomHeaders(array $headers): void;

    public function pushHeadersForFormat(FeedFormat $format): void;
}
