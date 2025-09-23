<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Heureka;

final class HeurekaCategoryText
{
    public function __construct(
        private readonly string $text
    ) {}

    public function getText(): string
    {
        return $this->text;
    }
}
