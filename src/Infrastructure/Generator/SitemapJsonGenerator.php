<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Domain\Sitemap\SitemapConfig;
use Lemonade\Feed\Infrastructure\Json\JsonExportable;

/**
 * @extends AbstractJsonFeedGenerator<SitemapConfig>
 */
final class SitemapJsonGenerator extends AbstractJsonFeedGenerator
{
    /**
     * @param iterable<JsonExportable> $items
     */
    protected function generateWrapped(iterable $items): void
    {
        $config = $this->getConfig();

        $stream = $this->getStream();
        $stream->write('{');

        $stream->write('"lang":' . json_encode($config->lang()->value, JSON_UNESCAPED_UNICODE));
        $stream->write(',');
        $stream->write('"urls":');
        $this->writeItems($items);

        $stream->write('}');
    }
}
