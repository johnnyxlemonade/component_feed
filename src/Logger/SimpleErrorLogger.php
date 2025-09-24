<?php declare(strict_types=1);

namespace Lemonade\Feed\Logger;
use Stringable;

final class SimpleErrorLogger extends AbstractFeedLogger
{
    public function log($level, string|Stringable $message, array $context = []): void
    {
        $contextStr = $context ? json_encode($context, JSON_UNESCAPED_UNICODE) : '';
        error_log(sprintf('[%s] %s %s', strtoupper((string)$level), (string)$message, $contextStr));
    }
}
