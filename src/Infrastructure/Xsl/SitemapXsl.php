<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Xsl;

final class SitemapXsl
{
    /**
     * Vrátí obsah XSL s daným jazykem.
     *
     * @param non-empty-string $lang
     */
    public static function content(string $lang = 'cs'): string
    {
        return SitemapXslTemplate::render(SitemapXslTranslations::get($lang));
    }

    /**
     * Uloží XSL soubor na disk.
     *
     * @param non-empty-string $path
     * @param non-empty-string $lang
     */
    public static function dump(string $path, string $lang = "cs"): void
    {
        file_put_contents($path, self::content($lang));
    }
}
