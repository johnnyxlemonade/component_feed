<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Zbozi;

use Lemonade\Feed\BaseGenerator;

/**
 * ZboziGenerator
 *
 * Generátor XML feedu pro Zbozi.cz.
 *
 * • Vygeneruje soubor pomocí `.latte` šablon
 * • Nastaví `Content-Type: application/xml`
 * • Vrací chybovou hlášku přes ZboziItem::getErrorString()
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrak <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
final class ZboziGenerator extends BaseGenerator
{
    /**
     * Vrací plně kvalifikovaný název třídy s chybovou hláškou.
     */
    protected function getItemClass(): string
    {
        return ZboziItem::class;
    }

}
