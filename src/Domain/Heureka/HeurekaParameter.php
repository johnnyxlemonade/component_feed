<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Heureka;

final class HeurekaParameter
{
    public function __construct(
        private readonly string $name,
        private readonly string $value,
        private ?string $unit = null
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    // Pomocná metoda pro JSON export
    public function toArray(): array
    {
        return [
            'name'  => $this->name,
            'value' => $this->value,
            'unit'  => $this->unit,
        ];
    }
}
