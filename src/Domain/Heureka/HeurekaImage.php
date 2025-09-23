<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Heureka;

final class HeurekaImage
{
    public function __construct(
        private readonly string $url
    ) {}

    public function getUrl(): string
    {
        return $this->url;
    }
}
