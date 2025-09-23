<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Heureka;

final class HeurekaParameter
{
    public function __construct(
        private readonly string $name,
        private readonly string $value
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
