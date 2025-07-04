<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Money;

use Lemonade\Feed\BaseGenerator;

/**
 * OrderGenerator
 *
 * Generátor XML objednávek pro export do systému Money.
 *
 * • Nastavuje hlavičku `application/xml`
 * • Používá šablony z adresáře `latte_order/`
 * • Generuje chybové hlášky na základě šablony `OrderHeader`
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrak <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
final class OrderGenerator extends BaseGenerator
{
    /**
     * Vrací plně kvalifikovaný název třídy s chybovou hláškou.
     */
    protected function getItemClass(): string
    {
        return OrderHeader::class;
    }
}
