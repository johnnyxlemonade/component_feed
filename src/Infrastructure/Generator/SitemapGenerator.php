<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Domain\Sitemap\SitemapConfig;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;
use Lemonade\Feed\Infrastructure\Xsl\SitemapXsl;
use Lemonade\Feed\Exception\IOErrorException;

/**
 * @extends AbstractXmlFeedGenerator<SitemapConfig>
 */
final class SitemapGenerator extends AbstractXmlFeedGenerator
{
    protected function getRootName(): string
    {
        return 'urlset';
    }

    protected function getRootAttributes(): array
    {
        return [
            'xmlns' => 'http://www.sitemaps.org/schemas/sitemap/0.9',
        ];
    }

    protected function beforeRoot(XmlStreamWriter $xml): void
    {
        $config = $this->getConfig();

        if (!$config->hasXsl()) {
            return;
        }

        $lang = $config->lang()->value;
        $filename = sprintf('sitemap-%s.xsl', $lang);

        try {
            // uloží XSL do stejné složky jako výstupní XML
            $this->getFilesystem()->write($filename, SitemapXsl::content($lang));

            // vypočítá veřejnou cestu (relativní k basePath)
            $href = $this->resolveHref($filename);

            // přidá XML instrukci
            $this->attachStylesheet($xml, $href);
        } catch (IOErrorException $e) {
            $this->getLogger()->logGeneratorError(static::class, $e);
        }
    }

    /**
     * Vrátí relativní URL XSL souboru v rámci stejné složky.
     */
    private function resolveHref(string $filename): string
    {
        $basePath = $this->getFilesystem()->getBasePath();

        // Base path -> relativní veřejná cesta (vždy s lomítky)
        $relative = str_replace('\\', '/', $basePath);

        // Pokus: najdi část za /storage/ a tu použij jako veřejný prefix
        if (($pos = strpos($relative, '/storage/')) !== false) {
            $relative = substr($relative, $pos);
        }

        // Spoj to se jménem XSL souboru
        $href = rtrim($relative, '/') . '/' . ltrim($filename, '/');

        // Odstraň ./ nebo dvojité lomítka
        return preg_replace('#/\.(/|$)#', '/', $href);
    }


    private function attachStylesheet(XmlStreamWriter $xml, string $href): void
    {
        $xml->pi('xml-stylesheet', sprintf('type="text/xsl" href="%s"', $href));
    }
}
