<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Adapter\Sitemap;

use Lemonade\Feed\Domain\DomainItemInterface;
use Lemonade\Feed\Domain\Sitemap\SitemapItem;
use Lemonade\Feed\Infrastructure\Adapter\HasDomainItem;
use Lemonade\Feed\Infrastructure\Json\JsonExportable;

final class SitemapItemJsonAdapter implements JsonExportable, HasDomainItem
{
    public function __construct(private readonly SitemapItem $item) {}

    public function getDomainItem(): DomainItemInterface
    {
        return $this->item;
    }

    public function toJson(): array
    {
        return [
            'loc'        => $this->item->getLoc(),
            'lastmod'    => $this->item->getLastMod()?->format('c'),
            'changefreq' => $this->item->getChangeFreq(),
            'priority'   => $this->item->getPriority(),
        ];
    }
}
