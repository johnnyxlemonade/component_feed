<?php declare(strict_types=1);

namespace Lemonade\Feed\Logger;

use Psr\Log\LoggerInterface as PsrLogger;
use Stringable;

final class FeedLogger extends AbstractFeedLogger
{
    public function __construct(
        private readonly PsrLogger $inner
    ) {}

    public function log($level, string|Stringable $message, array $context = []): void
    {
        $this->inner->log($level, $message, $context);
    }
}
