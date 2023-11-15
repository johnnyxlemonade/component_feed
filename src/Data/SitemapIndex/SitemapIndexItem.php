<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\SitemapIndex;
use Lemonade\Feed\BaseItem;

/**
 * SitemapIndexItem
 * @package Lemonade\Feed
 * @see https://www.sitemaps.org/protocol.html
 */  
final class SitemapIndexItem extends BaseItem
{

    /**
     * @param string $location
     */
    public function __construct(protected readonly string $location) {}

    /**
     * @return string
     */
    public function getLocation(): string
    {
        
        return $this->location;
    }

    /**
     * @return string
     */
    public static function getErrorString(): string
    {
        
        return "<?xml version=\"1.0\" encoding=\"UTF-8\"?><sitemapindex xmlns=\"https://www.sitemaps.org/schemas/sitemap/0.9\"></sitemapindex>";
    }

}