<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Infrastructure\IO\FilesystemInterface;
use Lemonade\Feed\Infrastructure\IO\OutputHeadersInterface;
use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;
use Psr\Http\Message\StreamInterface;

abstract class AbstractXmlFeedGenerator
{
    public function __construct(
        private readonly FilesystemInterface $filesystem,
        private readonly OutputHeadersInterface $headers,
        private readonly StreamInterface $stream
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

    /**
     * Hook – před root elementem (např. xml-stylesheet PI).
     */
    protected function beforeRoot(XmlStreamWriter $xml): void
    {
        // defaultně nic
    }

    /**
     * Hook – obsah uvnitř root elementu před položkami.
     */
    protected function beforeItems(XmlStreamWriter $xml): void
    {
        // defaultně nic
    }

    /**
     * Hook – obsah uvnitř root elementu po položkách.
     */
    protected function afterItems(XmlStreamWriter $xml): void
    {
        // defaultně nic
    }

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

    /**
     * @param iterable<XmlExportable> $items
     */
    public function generate(iterable $items): void
    {
        $writer = new XmlStreamWriter($this->stream);
        $writer->declaration();

        // nově
        $this->beforeRoot($writer);

        $writer->start($this->getRootName(), $this->getRootAttributes());

        $this->beforeItems($writer);

        foreach ($items as $item) {
            $item->toXml($writer);
        }

        $this->afterItems($writer);

        $writer->end($this->getRootName());
    }

    public function save(string $filename, iterable $items): void
    {
        $this->generate($items);
        $this->stream->rewind();
        $content = $this->stream->getContents();

        $this->filesystem->write($filename, $content);
    }

    public function output(iterable $items): void
    {
        $this->headers->pushXmlHeaders();

        $this->generate($items);
        $this->stream->rewind();
        echo $this->stream->getContents();
    }
}
