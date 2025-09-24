<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\FeedFormat;
use Psr\Http\Message\StreamInterface;

/**
 * Společná implementace pro Feed generátory (XML/JSON).
 *
 * @template T of object
 */
trait FeedGeneratorCommon
{
    /**
     * Uloží feed do souboru.
     *
     * @param iterable<T> $items
     */
    public function save(string $filename, iterable $items): void
    {
        $this->resetStream();
        $this->generate($items);

        $this->getStream()->rewind();
        $content = $this->getStream()->getContents();

        try {
            $this->getFilesystem()->write($filename, $content);
        } catch (\Throwable $e) {
            $this->getLogger()->logGeneratorError(static::class, $e);
        }
    }

    /**
     * Pošle feed rovnou do výstupu (s Content-Type headerem).
     *
     * @param iterable<T> $items
     */
    public function output(iterable $items): void
    {
        $this->getHeaders()->pushHeadersForFormat($this->getContentType());

        $this->resetStream();
        $this->generate($items);

        $this->getStream()->rewind();
        echo $this->getStream()->getContents();
    }

    /**
     * Vrátí feed jako stream (bez zápisu do souboru nebo výstupu).
     *
     * @param iterable<T> $items
     * @return StreamInterface
     */
    public function toStream(iterable $items): StreamInterface
    {
        $this->resetStream();
        $this->generate($items);

        $this->getStream()->rewind();
        return $this->getStream();
    }

    /**
     * Vrátí formát feedu (XML nebo JSON).
     */
    abstract protected function getContentType(): FeedFormat;

    /**
     * Hlavní generování obsahu feedu.
     *
     * @param iterable<T> $items
     */
    abstract protected function generate(iterable $items): void;
}
