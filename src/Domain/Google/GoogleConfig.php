<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Google;

use Lemonade\Feed\Domain\FeedConfigInterface;
use Lemonade\Feed\Domain\FeedType;

final class GoogleConfig implements FeedConfigInterface
{
    public function __construct(
        private readonly string $shopTitle,
        private readonly string $shopLink,
        private readonly string $shopDescription,
    ) {}

    public function shopTitle(): string
    {
        return $this->shopTitle;
    }

    public function shopLink(): string
    {
        return $this->shopLink;
    }

    public function shopDescription(): string
    {
        return $this->shopDescription;
    }

    public static function create(
        string $shopTitle = 'My Shop',
        string $shopLink = 'https://example.com',
        string $shopDescription = 'Google Merchant Feed'
    ): self {
        return new self($shopTitle, $shopLink, $shopDescription);
    }

    public function feedType(): FeedType
    {
        return FeedType::GOOGLE;
    }
}
