<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Google;

use Lemonade\Feed\BaseGenerator;

/**
 * GoogleGenerator
 *
 * Generátor XML feedu pro Google Merchant Center.
 *
 * • Vypisuje výstup v MIME typu `application/xml`
 * • Šablony načítá z podadresáře `latte/` v aktuálním modulu
 * • Generuje chybovou hlášku pomocí GoogleItem
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrak <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
final class GoogleGenerator extends BaseGenerator
{
    /**
     * Vrací plně kvalifikovaný název třídy s chybovou hláškou.
     */
    protected function getItemClass(): string
    {
        return GoogleItem::class;
    }
}