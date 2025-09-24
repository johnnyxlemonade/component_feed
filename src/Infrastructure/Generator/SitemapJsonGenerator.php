<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Domain\Sitemap\SitemapConfig;
use Lemonade\Feed\Infrastructure\Json\JsonExportable;
use Lemonade\Feed\Infrastructure\IO\FilesystemInterface;
use Lemonade\Feed\Infrastructure\IO\OutputHeadersInterface;
use Lemonade\Feed\Logger\FeedLoggerInterface;
use Psr\Http\Message\StreamInterface;

/**
 * JSON export Sitemap feedu
 */
final class SitemapJsonGenerator extends AbstractJsonFeedGenerator
{
    public function __construct(
        private readonly SitemapConfig $config,
        FilesystemInterface $filesystem,
        OutputHeadersInterface $headers,
        StreamInterface $stream,
        FeedLoggerInterface $logger
    ) {
        parent::__construct($filesystem, $headers, $stream, $logger);
    }

    /**
     * @param iterable<JsonExportable> $items
     */
    protected function generateWrapped(iterable $items): void
    {
        $stream = $this->getStream();
        $stream->write('{');

        $stream->write('"lang":' . json_encode($this->config->lang()->value, JSON_UNESCAPED_UNICODE));
        $stream->write(',');
        $stream->write('"urls":');
        $this->writeItems($items);

        $stream->write('}');
    }
}
