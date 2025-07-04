<?php declare(strict_types = 1);

namespace Lemonade\Feed;

/**
 * ParserInterface
 *
 * Rozhraní pro datové parsry používané v rámci Lemonade Frameworku.
 *
 * Každý parser implementující toto rozhraní musí být schopen stáhnout surová data,
 * ověřit jejich dostupnost, zpracovat je do strukturované podoby a nabídnout pomocné
 * funkce pro výpis nebo identifikaci jednotlivých prvků.
 *
 * Typickým použitím je parsování XML nebo jiných feedů pro interní využití.
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrak <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
interface ParserInterface
{
    /**
     * Vrací URL zdroje dat.
     */
    public function getUrl(): string;

    /**
     * Ověřuje, zda jsou dostupná data.
     *
     * @return bool
     */
    public function hasData(): bool;

    /**
     * Vrací zpracovaná data.
     *
     * @return array
     */
    public function getData(): array;

    /**
     * Vrací všechna původní data.
     *
     * @return array
     */
    public function getAllNodes(): array;

    /**
     * Inicializuje stažení a zpracování dat ze zdroje.
     *
     * @return void
     */
    public function downloadData();

    /**
     * Vrací původní surová (raw) data.
     *
     * @return array
     */
    public function rawData(): array;

    /**
     * Pomocná funkce pro výpis do výběrového pole.
     *
     * @return array
     */
    public function listDropdown(): array;

    /**
     * Vrací název položky podle jejího ID.
     *
     * @param string $id
     * @return string
     */
    public function getNodeNameById(string $id): string;
}