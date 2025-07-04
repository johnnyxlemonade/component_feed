<?php declare(strict_types = 1);

namespace Lemonade\Feed\Helper;

/**
 * HelperString
 *
 * Pomocné metody pro práci s textem, validací XML a konverzí kódování.
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrak <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
final class HelperString
{
    /**
     * Odstraní nevalidní znaky pro XML výstup (dle XML 1.0 specifikace).
     *
     * @param string|null $string
     * @return string|null
     */
    public static function fixString(?string $string): ?string
    {
        return ($string !== '')
            ? preg_replace(
                '/[^\x{0009}\x{000A}\x{000D}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u',
                ' ',
                $string
            )
            : null;
    }

    /**
     * Pokusí se převést řetězec na validní UTF-8 podle heuristiky.
     *
     * @param string|null $string
     * @return string|null
     */
    public static function fixUtf8(?string $string): ?string
    {
        if ($string === '' || $string === null) {
            return null;
        }

        // Validní UTF-8
        if (preg_match('/[\x80-\x{1FF}\x{2000}-\x{3FFF}]/u', $string)) {
            return $string;
        }

        // Pravděpodobně WINDOWS-1250
        if (preg_match('/[\x7F-\x9F\xBC]/', $string)) {
            return @iconv('WINDOWS-1250', 'UTF-8//IGNORE', $string);
        }

        // Fallback na ISO-8859-2
        return @iconv('ISO-8859-2', 'UTF-8//IGNORE', $string);
    }
}