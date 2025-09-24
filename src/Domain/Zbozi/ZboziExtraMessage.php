<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Zbozi;

final class ZboziExtraMessage
{
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    // Getter pro type
    public function getType(): string
    {
        return $this->type;
    }

    // Pomocná metoda pro JSON export
    public function toArray(): array
    {
        return [
            'type' => $this->type,
        ];
    }
}
