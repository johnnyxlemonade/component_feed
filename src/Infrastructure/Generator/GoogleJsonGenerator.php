<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Domain\Google\GoogleConfig;
use Lemonade\Feed\Infrastructure\Json\JsonExportable;
use Lemonade\Feed\Infrastructure\IO\FilesystemInterface;
use Lemonade\Feed\Infrastructure\IO\OutputHeadersInterface;
use Lemonade\Feed\Logger\FeedLoggerInterface;
use Psr\Http\Message\StreamInterface;

/**
 * JSON export Google Merchant feedu
 */
final class GoogleJsonGenerator extends AbstractJsonFeedGenerator
{
    public function __construct(
        private readonly GoogleConfig $config,
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

        $stream->write('"title":' . json_encode($this->config->shopTitle(), JSON_UNESCAPED_UNICODE));
        $stream->write(',');
        $stream->write('"link":' . json_encode($this->config->shopLink(), JSON_UNESCAPED_UNICODE));
        $stream->write(',');
        $stream->write('"description":' . json_encode($this->config->shopDescription(), JSON_UNESCAPED_UNICODE));
        $stream->write(',');
        $stream->write('"items":');
        $this->writeItems($items);

        $stream->write('}');
    }
}
