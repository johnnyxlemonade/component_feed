<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Zbozi;

final class ZboziCategoryText
{
    public function __construct(
        private readonly string $text
    ) {}

    // Getter pro text
    public function getText(): string
    {
        return $this->text;
    }

    // JSON export
    public function toArray(): array
    {
        return [
            'text' => $this->text,
        ];
    }
}
