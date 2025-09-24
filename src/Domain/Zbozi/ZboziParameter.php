<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Zbozi;

final class ZboziParameter
{
    private string $name;
    private string $value;
    private ?string $unit;

    public function __construct(
        string $name,
        string $value,
        ?string $unit = null
    ) {
        $this->name = $name;
        $this->value = $value;
        $this->unit = $unit;
    }

    // Getter metody pro vlastnosti
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
