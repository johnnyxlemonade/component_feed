<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Domain\Sitemap\SitemapConfig;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;
use Lemonade\Feed\Infrastructure\Xsl\SitemapXsl;
use Lemonade\Feed\Exception\IOErrorException;

final class SitemapGenerator extends AbstractXmlFeedGenerator
{
    public function __construct(
        private readonly SitemapConfig $config,
                                       ...$deps // filesystem, headers, stream
    ) {
        parent::__construct(...$deps);
    }

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
        if (!$this->config->withXsl() || $this->config->xslHref() === null) {
            return;
        }

        $href = $this->buildHrefWithLang($this->config->xslHref());

        try {
            $this->storeXsl($href, $this->config->lang()->value);
            $this->attachStylesheet($xml, $href);
        } catch (IOErrorException $e) {
            // TODO: logovat přes LoggerInterface
            error_log("Failed to write XSL: {$e->getMessage()}");
        }
    }

    private function buildHrefWithLang(string $href): string
    {
        $href = $this->normalizeHref($href);

        $info = pathinfo($href);
        return $info['dirname'] . '/' . $info['filename'] . '-' . $this->config->lang()->value . '.xsl';
    }

    private function storeXsl(string $href, string $lang): void
    {
        // Tady už necháváme Filesystem házet IOErrorException
        $this->getFilesystem()->write(
            $href,
            SitemapXsl::content($lang)
        );
    }

    private function attachStylesheet(XmlStreamWriter $xml, string $href): void
    {
        $xml->pi(
            'xml-stylesheet',
            sprintf('type="text/xsl" href="%s"', $href)
        );
    }

    private function normalizeHref(string $href): string
    {
        if (str_starts_with($href, 'http')) {
            return $href;
        }
        return '/' . ltrim($href, '/');
    }
}
