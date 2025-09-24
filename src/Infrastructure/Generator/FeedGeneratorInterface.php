<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

interface FeedGeneratorInterface
{
    /**
     * Uloží feed do souboru.
     *
     * @param iterable<object> $items
     */
    public function save(string $filename, iterable $items): void;

    /**
     * Pošle feed rovnou do výstupu (Content-Type header + echo).
     *
     * @param iterable<object> $items
     */
    public function output(iterable $items): void;
}
