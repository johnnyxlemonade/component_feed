<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Adapter;

use InvalidArgumentException;

// Domain
use Lemonade\Feed\Domain\Sitemap\SitemapItem;
use Lemonade\Feed\Domain\Heureka\HeurekaItem;
use Lemonade\Feed\Domain\Google\GoogleItem;
use Lemonade\Feed\Domain\Zbozi\ZboziItem;

// Adapters – Sitemap
use Lemonade\Feed\Infrastructure\Adapter\Sitemap\SitemapItemXmlAdapter;
use Lemonade\Feed\Infrastructure\Adapter\Sitemap\SitemapItemJsonAdapter;

// Adapters – Heureka
use Lemonade\Feed\Infrastructure\Adapter\Heureka\HeurekaItemXmlAdapter;
use Lemonade\Feed\Infrastructure\Adapter\Heureka\HeurekaItemJsonAdapter;

// Adapters – Google
use Lemonade\Feed\Infrastructure\Adapter\Google\GoogleItemXmlAdapter;
use Lemonade\Feed\Infrastructure\Adapter\Google\GoogleItemJsonAdapter;

// Adapters – Zbozi
use Lemonade\Feed\Infrastructure\Adapter\Zbozi\ZboziItemXmlAdapter;
use Lemonade\Feed\Infrastructure\Adapter\Zbozi\ZboziItemJsonAdapter;

// Exportable interfaces
use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Json\JsonExportable;

final class AdapterFactory
{
    /**
     * @template T of object
     * @param T $item
     */
    public function toXml(object $item): XmlExportable
    {
        return match (true) {
            $item instanceof SitemapItem => new SitemapItemXmlAdapter($item),
            $item instanceof HeurekaItem => new HeurekaItemXmlAdapter($item),
            $item instanceof GoogleItem  => new GoogleItemXmlAdapter($item),
            $item instanceof ZboziItem   => new ZboziItemXmlAdapter($item),
            default => throw new InvalidArgumentException(
                'Unsupported XML export for type ' . $item::class
            ),
        };
    }

    /**
     * @template T of object
     * @param T $item
     */
    public function toJson(object $item): JsonExportable
    {
        return match (true) {
            $item instanceof SitemapItem => new SitemapItemJsonAdapter($item),
            $item instanceof HeurekaItem => new HeurekaItemJsonAdapter($item),
            $item instanceof GoogleItem  => new GoogleItemJsonAdapter($item),
            $item instanceof ZboziItem   => new ZboziItemJsonAdapter($item),
            default => throw new InvalidArgumentException(
                'Unsupported JSON export for type ' . $item::class
            ),
        };
    }
}
