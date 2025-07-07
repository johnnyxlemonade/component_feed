<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\OpenSearch;

use Lemonade\Feed\BaseGenerator;

/**
 * Generátor XML pro OpenSearch integraci.
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrak <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
final class OpenSearchGenerator extends BaseGenerator
{
    /**
     * Vrací plně kvalifikovaný název třídy s chybovou hláškou.
     */
    protected function getItemClass(): string
    {
        return OpenSearchItem::class;
    }
}