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

        if (!$config->withXsl() || $config->xslHref() === null) {
            return;
        }

        $href = $this->buildHrefWithLang($config->xslHref(), $config->lang()->value);

        try {
            $this->storeXsl($href, $config->lang()->value);
            $this->attachStylesheet($xml, $href);
        } catch (IOErrorException $e) {
            $this->getLogger()->logGeneratorError(static::class, $e);
        }
    }

    private function buildHrefWithLang(string $href, string $lang): string
    {
        $href = $this->normalizeHref($href);

        $info = pathinfo($href);
        return $info['dirname'] . '/' . $info['filename'] . '-' . $lang . '.xsl';
    }

    private function storeXsl(string $href, string $lang): void
    {
        $this->getFilesystem()->write(
            $href,
            SitemapXsl::content($lang)
        );
    }

    private function attachStylesheet(XmlStreamWriter $xml, string $href): void
    {
        $xml->pi('xml-stylesheet', sprintf('type="text/xsl" href="%s"', $href));
    }

    private function normalizeHref(string $href): string
    {
        if (str_starts_with($href, 'http')) {
            return $href;
        }

        $href = ltrim($href, '/');
        return rtrim($href, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }
}
