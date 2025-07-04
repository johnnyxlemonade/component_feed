<?php declare(strict_types = 1);

namespace Lemonade\Feed;

/**
 * ItemInterface
 *
 * Rozhraní pro validovatelné datové položky ve frameworku Lemonade.
 *
 * Každá třída reprezentující datový objekt (např. položku ve feedu) musí implementovat
 * metodu `validate()` pro kontrolu povinných polí a metodu `getErrorString()` pro vrácení
 * popisu chyby v případě nevalidního stavu.
 *
 * Součást Lemonade Frameworku – navrženo pro čistý, bezpečný a rozšiřitelný datový přenos.
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrak <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
interface ItemInterface
{
    /**
     * Validuje položku – ověří, zda jsou vyplněná všechna povinná pole.
     */
    public function validate(): bool;

    /**
     * Vrací popis chyby, pokud validace selže.
     */
    public static function getErrorString(): string;
}
