<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Domain\Google\GoogleConfig;
use Lemonade\Feed\Infrastructure\Json\JsonExportable;

/**
 * @extends AbstractJsonFeedGenerator<GoogleConfig>
 */
final class GoogleJsonGenerator extends AbstractJsonFeedGenerator
{
    /**
     * @param iterable<JsonExportable> $items
     */
    protected function generateWrapped(iterable $items): void
    {
        $config = $this->getConfig();
        $stream = $this->getStream();

        $stream->write('{');
        $stream->write('"title":' . json_encode($config->shopTitle(), JSON_UNESCAPED_UNICODE));
        $stream->write(',');
        $stream->write('"link":' . json_encode($config->shopLink(), JSON_UNESCAPED_UNICODE));
        $stream->write(',');
        $stream->write('"description":' . json_encode($config->shopDescription(), JSON_UNESCAPED_UNICODE));
        $stream->write(',');
        $stream->write('"items":');
        $this->writeItems($items);
        $stream->write('}');
    }
}
