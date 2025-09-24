<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Infrastructure\IO\FilesystemInterface;
use Lemonade\Feed\Infrastructure\IO\OutputHeadersInterface;
use Lemonade\Feed\Logger\FeedLoggerInterface;
use Psr\Http\Message\StreamInterface;

abstract class AbstractFeedGenerator implements FeedGeneratorInterface
{
    public function __construct(
        private readonly FilesystemInterface $filesystem,
        private readonly OutputHeadersInterface $headers,
        private readonly StreamInterface $stream,
        private readonly FeedLoggerInterface $logger
    ) {}

    protected function getFilesystem(): FilesystemInterface
    {
        return $this->filesystem;
    }

    protected function getHeaders(): OutputHeadersInterface
    {
        return $this->headers;
    }

    protected function getStream(): StreamInterface
    {
        return $this->stream;
    }

    protected function getLogger(): FeedLoggerInterface
    {
        return $this->logger;
    }

    /**
     * Resetuje obsah streamu (rewind + truncate).
     */
    protected function resetStream(): void
    {
        if ($this->stream->isSeekable()) {
            $this->stream->rewind();
        }

        if ($this->stream->isWritable()) {
            try {
                $this->stream->truncate(0);
            } catch (\Throwable) {
                // některé implementace truncate nepodporují
            }
        }
    }
}
