<?php declare(strict_types=1);

namespace Lemonade\Feed\Logger;
use Stringable;

final class NullLogger extends AbstractFeedLogger
{
    public function log($level, string|Stringable $message, array $context = []): void
    {
        // intentionally no-op
    }
}
