<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Sitemap;

use Lemonade\Feed\BaseGenerator;

/**
 * Generátor XML pro Google Sitemap.
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