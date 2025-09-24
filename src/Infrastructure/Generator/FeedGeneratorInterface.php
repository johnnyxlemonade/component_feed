<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Psr\Http\Message\StreamInterface;

/**
 * @template T of object
 */
interface FeedGeneratorInterface
{
    /**
     * Uloží feed do souboru.
     *
     * @param iterable<T> $items
     */
    public function save(string $filename, iterable $items): void;

    /**
     * Pošle feed rovnou do výstupu (Content-Type header + echo).
     *
     * @param iterable<T> $items
     */
    public function output(iterable $items): void;

    /**
     * Vrátí feed jako stream (bez zápisu do souboru nebo výstupu).
     *
     * @param iterable<T> $items
     * @return StreamInterface
     */
    public function toStream(iterable $items): StreamInterface;
}
