<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Zbozi;

use Lemonade\Feed\CsvParser;
use Lemonade\Feed\Helper\HelperString;

/**
 * ZboziCategories
 *
 * Parser kategorií pro feed Zbozi.cz.
 *
 * • Stahuje CSV z oficiálního endpointu
 * • Parsuje ID, název, hierarchii a cestu kategorie
 * • Upravuje UTF-8, oddělovače a generuje hash pro porovnání změn
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrak <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
final class ZboziCategories extends CsvParser
{
    /**
     * URL kategorie feedu Zbozi.cz
     * @var string
     */
    public const ENDPOINT_URL = 'https://www.zbozi.cz/static/categories.csv';

    /**
     * Vrací endpoint URL.
     */
    public function getUrl(): string
    {
        return self::ENDPOINT_URL;
    }

    /**
     * Načte a zpracuje surová CSV data z feedu.
     *
     * @return array
     */
    public function rawData(): array
    {
        $data  = [];
        $first = true;

        try {
            $handle = fopen($this->cacheUrl, 'r');

            while (($row = fgetcsv($handle, 1000, ';')) !== false) {
                if ($first) {
                    $first = false;
                    continue;
                }

                $row  = array_map([HelperString::class, 'fixUtf8'], $row);
                $path = explode(' | ', $row[2]);
                $main = $path[0] ?? '';

                $id   = $this->filterName($row[0]);
                $name = $this->filterName($row[1]);
                $full = $this->filterName($row[2]);

                $data[$id] = [
                    'feed_category_id'      => $id,
                    'feed_category_name'    => $name,
                    'feed_category_main'    => $this->filterName($main),
                    'feed_category_path'    => $full,
                    'feed_category_explode' => str_replace('|', '###', $full),
                    'zbozi_hash'            => md5(json_encode($row)),
                ];
            }

            fclose($handle);
        } catch (\Exception $e) {
            // TODO: ošetření výjimky
        }

        return $data;
    }
}
