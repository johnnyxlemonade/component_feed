<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Infrastructure\IO\FilesystemInterface;
use Lemonade\Feed\Infrastructure\IO\OutputHeadersInterface;
use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;
use Lemonade\Feed\Logger\FeedLoggerInterface;
use Psr\Http\Message\StreamInterface;

abstract class AbstractXmlFeedGenerator
{
    public function __construct(
        private readonly FilesystemInterface $filesystem,
        private readonly OutputHeadersInterface $headers,
        private readonly StreamInterface $stream,
        private readonly FeedLoggerInterface $logger
    ) {}

    /**
     * Název root elementu (např. urlset, SHOP, rss).
     */
    abstract protected function getRootName(): string;

    /**
     * Volitelné atributy root elementu (např. xmlns).
     *
     * @return array<string,string>
     */
    protected function getRootAttributes(): array
    {
        return [];
    }

    protected function beforeRoot(XmlStreamWriter $xml): void {}
    protected function beforeItems(XmlStreamWriter $xml): void {}
    protected function afterItems(XmlStreamWriter $xml): void {}

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
     * @param iterable<XmlExportable> $items
     */
    public function generate(iterable $items): void
    {
        if ($this->stream->isSeekable()) {
            $this->stream->rewind();
        }
        if ($this->stream->isWritable()) {
            try {
                $this->stream->truncate(0);
            } catch (\Throwable) {
                // ignore if truncate not supported
            }
        }

        $writer = new XmlStreamWriter($this->stream);
        $writer->declaration();

        $this->beforeRoot($writer);

        $writer->start($this->getRootName(), $this->getRootAttributes());

        $this->beforeItems($writer);

        foreach ($items as $item) {
            try {
                $item->toXml($writer);
            } catch (\Throwable $e) {
                // místo generického error() použijeme doménovou metodu
                $this->logger->logInvalidItem($item, [
                    'exception' => $e->getMessage(),
                ]);
            }
        }

        $this->afterItems($writer);

        $writer->end($this->getRootName());
    }


    public function save(string $filename, iterable $items): void
    {
        $this->generate($items);
        $this->stream->rewind();
        $content = $this->stream->getContents();

        try {
            $this->filesystem->write($filename, $content);
        } catch (\Throwable $e) {
            $this->logger->logGeneratorError(static::class, $e);
        }
    }

    public function output(iterable $items): void
    {
        $this->headers->pushXmlHeaders();

        $this->generate($items);
        $this->stream->rewind();
        echo $this->stream->getContents();
    }
}
