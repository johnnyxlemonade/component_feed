<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Heureka;

use Lemonade\Feed\BaseGenerator;

/**
 * HeurekaGenerator
 *
 * Generátor XML feedu pro Heureka.cz.
 *
 * • Nastavuje správnou MIME hlavičku `application/xml`
 * • Načítá šablony z adresáře `latte/` ve svém modulu
 * • Vrací chybovou hlášku definovanou v `HeurekaItem`
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrak <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
final class HeurekaGenerator extends BaseGenerator
{
    /**
     * Vrací plně kvalifikovaný název třídy s chybovou hláškou.
     */
    protected function getItemClass(): string
    {
        return HeurekaItem::class;
    }
}
