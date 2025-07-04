<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Sitemap;

use Lemonade\Feed\BaseGenerator;

/**
 * SitemapGenerator
 *
 * Generátor XML pro Google Sitemap.
 *
 * • Vygeneruje sitemap soubor ze šablony (`latte/`)
 * • Nastavuje `Content-Type: application/xml`
 * • Vrací chybovou hlášku přes SitemapItem::getErrorString()
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrak <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
final class SitemapGenerator extends BaseGenerator
{
    /**
     * Vrací plně kvalifikovaný název třídy s chybovou hláškou.
     */
    protected function getItemClass(): string
    {
        return SitemapItem::class;
    }
}
