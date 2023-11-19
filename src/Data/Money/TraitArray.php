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
     * @return string
     */
    public function __call(string $name, mixed $arguments): string
    {

        if (str_starts_with($name, "get")) {

            $index = lcfirst(string: substr(string: $name, offset: 3));

            return (string) ($this->data[$index] ?? "");
        }

        return "";
    }
}