<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Infrastructure\Json\JsonExportable;
use Lemonade\Feed\Infrastructure\IO\FilesystemInterface;
use Lemonade\Feed\Infrastructure\IO\OutputHeadersInterface;
use Lemonade\Feed\Logger\FeedLoggerInterface;
use Psr\Http\Message\StreamInterface;

/**
 * JSON export Heureka feedu
 */
final class HeurekaJsonGenerator extends AbstractJsonFeedGenerator
{
    /**
     * @param iterable<JsonExportable> $items
     */
    protected function generateWrapped(iterable $items): void
    {
        $stream = $this->getStream();
        $stream->write('{' );
        $stream->write('"products":');
        $this->writeItems($items);
        $stream->write('}');
    }
}
