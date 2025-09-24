<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Sitemap;

use Lemonade\Feed\Domain\FeedConfigInterface;
use Lemonade\Feed\Domain\FeedType;

final class SitemapConfig implements FeedConfigInterface
{
    public function __construct(
        private readonly bool $withXsl,
        private readonly SitemapLang $lang,
        private readonly ?string $xslHref = null,
    ) {}

    public function withXsl(): bool
    {
        return $this->withXsl;
    }

    public function lang(): SitemapLang
    {
        return $this->lang;
    }

    public function xslHref(): ?string
    {
        return $this->xslHref;
    }

    public static function create(
        bool $withXsl = false,
        ?string $lang = null,
        ?string $xslHref = null,
    ): self {
        return new self(
            $withXsl,
            SitemapLang::tryFrom($lang) ?? SitemapLang::CS,
            $xslHref
        );
    }

    public function feedType(): FeedType
    {
        return FeedType::SITEMAP;
    }
}
