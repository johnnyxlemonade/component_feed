<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Adapter\Sitemap;

use Lemonade\Feed\Domain\DomainItemInterface;
use Lemonade\Feed\Domain\Sitemap\SitemapItem;
use Lemonade\Feed\Infrastructure\Adapter\HasDomainItem;
use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;

final class SitemapItemXmlAdapter implements XmlExportable, HasDomainItem
{
    public function __construct(private readonly SitemapItem $item) {}

    public function getDomainItem(): DomainItemInterface
    {
        return $this->item;
    }

    public function toXml(XmlStreamWriter $xml): void
    {
        $xml->start('url');

        $xml->element('loc', $this->item->getLoc());
        $xml->element('lastmod', $this->item->getLastMod()?->format('c'));
        $xml->element('changefreq', $this->item->getChangeFreq());
        $xml->element(
            'priority',
            $this->item->getPriority() !== null
                ? number_format($this->item->getPriority(), 1)
                : null
        );

        $xml->end('url');
    }
}

