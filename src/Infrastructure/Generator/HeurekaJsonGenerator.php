<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Domain\Heureka\HeurekaConfig;
use Lemonade\Feed\Infrastructure\Json\JsonExportable;

/**
 * JSON export Heureka feedu
 *
 * @extends AbstractJsonFeedGenerator<HeurekaConfig>
 */
final class HeurekaJsonGenerator extends AbstractJsonFeedGenerator
{
    /**
     * @param iterable<JsonExportable> $items
     */
    protected function generateWrapped(iterable $items): void
    {
        $stream = $this->getStream();
        $stream->write('{');
        $stream->write('"offers":');
        $this->writeItems($items);
        $stream->write('}');
    }
}
