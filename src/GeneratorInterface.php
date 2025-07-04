<?php declare(strict_types = 1);

namespace Lemonade\Feed;

/**
 * GeneratorInterface
 *
 * Rozhraní pro generátory exportních souborů (např. XML/CSV feedy).
 *
 * Každý generátor musí umožnit přidávání položek (`ItemInterface`), výstup
 * do standardního výstupu nebo ukládání do souboru. Možnost předání volitelného
 * callbacku umožňuje upravit výstup (např. obalení XML, hlavičky apod.).
 *
 * Součást Lemonade Frameworku – navrženo pro snadné generování výstupních datových struktur.
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrak <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
interface GeneratorInterface
{
    /**
     * Přidá položku do generovaného souboru.
     */
    public function addItem(ItemInterface $item);

    /**
     * Vygeneruje výstup (např. XML) a odešle ho do výstupního bufferu.
     */
    public function output(string $callback = null);

    /**
     * Ulozeni souboru
     */
    public function save(string $filename = null, string $callback = null);
}