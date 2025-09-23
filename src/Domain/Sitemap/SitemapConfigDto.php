<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Sitemap;

final class SitemapConfigDto
{
    public function __construct(
        public readonly bool $withXsl = false,
        public readonly SitemapLang $lang = SitemapLang::CS,
        public readonly ?string $xslHref = null,
    ) {}

    public static function create(
        bool $withXsl = false,
        ?string $lang = null,
        ?string $xslHref = null,
    ): self {
        return new self(
            $withXsl,
            SitemapLang::fromOrDefault($lang),
            $xslHref
        );
    }
}
