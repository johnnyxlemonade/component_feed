<?php declare(strict_types=1);

namespace Lemonade\Feed\Validator;

interface FeedValidatorInterface
{
    /**
     * @template T of object
     * @param iterable<T> $items Doménové entity k validaci
     * @return \Generator<T> Pouze validní entity
     */
    public function validateStream(iterable $items): \Generator;
}
