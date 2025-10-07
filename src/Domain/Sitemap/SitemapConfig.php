<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Sitemap;

use Lemonade\Feed\Domain\FeedConfigInterface;
use Lemonade\Feed\Domain\FeedType;

final class SitemapConfig implements FeedConfigInterface
{
    public function __construct(
        private readonly SitemapLang $lang,
        private readonly bool $createXsl = false
    ) {}

    public function hasXsl(): bool
    {
        return $this->createXsl;
    }

    public function lang(): SitemapLang
    {
        return $this->lang;
    }

    public function feedType(): FeedType
    {
        return FeedType::SITEMAP;
    }
}
