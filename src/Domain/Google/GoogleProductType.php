<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Google;

final class GoogleProductType
{
    public function __construct(private string $text) {}
    public function getText(): string { return $this->text; }
}
