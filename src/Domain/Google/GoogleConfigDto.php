<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Google;

final class GoogleConfigDto
{
    public function __construct(
        public readonly string $shopTitle,
        public readonly string $shopLink,
        public readonly string $shopDescription,
    ) {}

    public static function create(
        string $shopTitle = 'My Shop',
        string $shopLink = 'https://example.com',
        string $shopDescription = 'Google Merchant Feed'
    ): self {
        return new self(
            $shopTitle,
            $shopLink,
            $shopDescription
        );
    }
}
