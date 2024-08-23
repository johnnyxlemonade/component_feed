<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Money;
use function lcfirst;
use function substr;

/**
 * @TraitArray
 * @\Lemonade\Feed\Data\Money\TraitArray
 */
trait TraitArray
{

    /**
     * @param array $data
     */
    public function __construct(protected readonly array $data = [])
    {
    }

    /**
     * @param string $name
     * @param mixed $arguments
     * @return bool|string
     */
    public function __call(string $name, mixed $arguments): bool|string
    {

        if (str_starts_with(haystack: $name, needle: "get")) {

            $index = lcfirst(string: substr(string: $name, offset: 3));

            return (string) ($this->data[$index] ?? "");
        }

        if (str_starts_with(haystack: $name, needle: "generate")) {

            $index = lcfirst(string: substr(string: $name, offset: 8));

            return (bool) (((int) $this->data[$index] ?? 0) === 1);
        }

        return "";
    }

}