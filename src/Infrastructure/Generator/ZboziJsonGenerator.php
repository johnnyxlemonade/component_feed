<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Domain\Zbozi\ZboziConfig;
use Lemonade\Feed\Infrastructure\Json\JsonExportable;

/**
 * JSON export Zbozi feedu
 *
 * @extends AbstractJsonFeedGenerator<ZboziConfig>
 */
final class ZboziJsonGenerator extends AbstractJsonFeedGenerator
{
    /**
     * @param iterable<JsonExportable> $items
     */
    protected function generateWrapped(iterable $items): void
    {
        $stream = $this->getStream();
        $stream->write('{');
        $stream->write('"products":');
        $this->writeItems($items);
        $stream->write('}');
    }
}
