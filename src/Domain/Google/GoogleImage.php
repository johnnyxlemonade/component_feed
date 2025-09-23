<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Google;

final class GoogleImage
{
    public function __construct(private string $url) {}
    public function getUrl(): string { return $this->url; }
}
