<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Google;

use Lemonade\Feed\CsvParser;
use Lemonade\Feed\Helper\HelperString;

/**
 * GoogleCategories
 *
 * Parser kategorií pro feed Google Merchant Center.
 *
 * • Stahuje textový taxonomy feed (s ID) z oficiálního endpointu
 * • Rozpoznává hierarchii kategorií podle `>`
 * • Vytváří strukturu podobnou feedu Zboží.cz s rozkladem cesty
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrak <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
final class GoogleCategories extends CsvParser
{
    /**
     * URL taxonomy souboru Google Merchant Center (česká verze)
     * @var string
     */
    public const ENDPOINT_URL = 'https://www.google.com/basepages/producttype/taxonomy-with-ids.cs-CZ.txt';

    /**
     * Vrací endpoint URL.
     */
    public function getUrl(): string
    {
        return self::ENDPOINT_URL;
    }

    /**
     * Načte a zpracuje surový textový taxonomy feed Google.
     *
     * @return array
     */
    public function rawData(): array
    {
        $data  = [];
        $first = true;

        try {
            $handle = fopen($this->cacheUrl, 'r');

            while (($line = fgets($handle, 1000)) !== false) {
                if ($first) {
                    $first = false;
                    continue;
                }

                $line = HelperString::fixUtf8(trim($line));
                $tmp  = explode(' - ', $line, 2);

                if (count($tmp) !== 2) {
                    continue; // neplatný řádek
                }

                $id   = $this->filterName($tmp[0]);
                $path = $this->filterName($tmp[1]);

                if (strpos($path, '>') !== false) {
                    $parts = explode(' > ', $path);
                    $data[$id] = [
                        'feed_category_id'      => $id,
                        'feed_category_name'    => $this->filterName(end($parts)),
                        'feed_category_main'    => $this->filterName($parts[0]),
                        'feed_category_path'    => $path,
                        'feed_category_explode' => str_replace('>', '###', $path),
                    ];
                } else {
                    $data[$id] = [
                        'feed_category_id'      => $id,
                        'feed_category_name'    => $path,
                        'feed_category_main'    => null,
                        'feed_category_path'    => $path,
                        'feed_category_explode' => $path,
                    ];
                }
            }

            fclose($handle);
        } catch (\Throwable $e) {
            // TODO: log nebo výjimka podle potřeby
        }

        return $data;
    }
}