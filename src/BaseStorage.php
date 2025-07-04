<?php declare(strict_types = 1);

namespace Lemonade\Feed;

/**
 * BaseStorage
 *
 * Služba pro ukládání výstupních souborů na disk.
 *
 * • Ukládá soubory do určeného adresáře
 * • Automaticky vytvoří složky, pokud neexistují
 * • Vrací relativní nebo absolutní cestu k výsledku
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrak <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
final class BaseStorage
{
    /**
     * Kořenová složka úložiště
     *
     * @var string
     */
    protected string $root = './storage/0/export';

    /**
     * Relativní podadresář (volitelný)
     *
     * @var string|null
     */
    protected ?string $directory = null;

    /**
     * Konstruktor – nastaví cílový podadresář.
     *
     * @param string|null $directory
     */
    public function __construct(?string $directory = null)
    {
        $this->directory = $directory;
    }

    /**
     * Uloží obsah do souboru.
     *
     * @param string $filename Název souboru
     * @param string $content  Obsah
     * @return string|false    Cesta k souboru nebo false při chybě
     */
    public function save(string $filename, string $content)
    {
        try {
            $dir = $this->getDir();

            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }

            $file = $this->getFile($filename, true);

            if (file_put_contents($file, $content, LOCK_EX)) {
                return $this->getFile($filename, false);
            }

            return false;
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Vrací cestu k výstupnímu adresáři.
     *
     * @param bool $absolute Vrátit absolutní cestu?
     * @return string
     */
    public function getDir(bool $absolute = false): string
    {
        $dir = $this->root . (!empty($this->directory) ? DIRECTORY_SEPARATOR . $this->directory : '');
        return $absolute ? realpath($dir) ?: $dir : $dir;
    }

    /**
     * Vrací úplnou cestu k výstupnímu souboru.
     *
     * @param string $file     Název souboru
     * @param bool   $absolute Vrátit absolutní cestu?
     * @return string
     */
    public function getFile(string $file, bool $absolute = false): string
    {
        return $this->getDir($absolute) . DIRECTORY_SEPARATOR . $file;
    }

}
