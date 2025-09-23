<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Domain\Sitemap\SitemapConfigDto;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;
use Lemonade\Feed\Infrastructure\Xsl\SitemapXsl;

final class SitemapGenerator extends AbstractXmlFeedGenerator
{
    public function __construct(
        private readonly SitemapConfigDto $config,
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
        if (!$this->config->withXsl || $this->config->xslHref === null) {
            return;
        }

        $href = $this->normalizeHref($this->config->xslHref);
        $hrefWithLang = preg_replace('/\.xsl$/', $this->config->lang->value . '.xsl', $href);

        try {
            $this->getFilesystem()->write(
                ltrim($hrefWithLang, '/'),
                SitemapXsl::content($this->config->lang->value)
            );

            $xml->pi(
                'xml-stylesheet',
                sprintf('type="text/xsl" href="%s"', $hrefWithLang)
            );
        } catch (\Throwable $e) {
            // TODO: logovat chybu místo tichého ignorování
        }
    }

    private function normalizeHref(string $href): string
    {
        if (str_starts_with($href, 'http')) {
            return $href;
        }
        return '/' . ltrim($href, '/');
    }
}
