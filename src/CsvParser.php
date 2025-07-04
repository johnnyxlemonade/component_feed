<?php declare(strict_types = 1);

namespace Lemonade\Feed;

use Lemonade\Feed\Cache\FileSystem;

/**
 * CsvParser
 *
 * Abstraktní parser CSV feedů pro Lemonade Framework.
 *
 * • Stará se o stažení a cachování vzdáleného CSV do filesystemu
 * • Poskytuje utilitní metody pro práci s kategoriemi (uzly)
 * • Konkrétní potomci jen implementují `rawData()` a případné
 *   specifické transformace
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrák <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
abstract class CsvParser implements ParserInterface
{
    /** @var int Doba platnosti cache (30 dní) */
    protected int $cacheTime = 2_592_000;

    /** @var string Identifikátor / název cache souboru */
    protected string $cacheFile = 'download-file';

    /** @var array Načtená/parsnutá data */
    protected array $cacheData = [];

    /** @var string|null URL vzdáleného CSV zdroje */
    protected ?string $cacheUrl = null;

    /**
     * Constructor
     */
    public function __construct(string $endpointUrl, bool $forceDownload = true)
    {
        $this->cacheUrl  = $endpointUrl;
        $this->cacheData = $forceDownload ? $this->downloadData() : [];
    }

    /**
     * Stáhne data z cache nebo vzdáleného zdroje.
     *
     * @return array|false Načtená/parsnutá data nebo false při chybě
     */
    public function downloadData()
    {
        try {
            $cache = FileSystem::getInstance($this->cacheUrl, true);
            $data  = $cache->load($cache->getFileId(), $this->cacheTime);

            if (!$data) {
                return $cache->save($cache->getFileId(), $this->rawData());
            }

            return $data;
        } catch (\Throwable $e) {
            // TODO: logování nebo přeposlání výjimky podle potřeby
        }

        return false;
    }


    /**
     * Vrací hlavní kořenové kategorie s počtem položek.
     *
     * @return array<string,string>
     */
    public function getMainNodes(): array
    {
        $out = [];

        if ($map = $this->listDropdown()) {
            foreach (array_keys($map) as $name) {
                $out[$name] = sprintf('%s [%d]', $name, count($map[$name]));
            }
        }

        return $out;
    }

    /**
     * Vrací data pro vybrané kategorie podle názvů.
     *
     * @param string[] $name
     * @return array
     */
    public function getNodeArrayByName(array $name): array
    {
        $test = $this->listDropdown();
        $data = [];

        if ($test) {
            foreach (array_keys($test) as $cat) {
                if (in_array($cat, $name, true)) {
                    $data[$cat] = $test[$cat];
                }
            }
        }

        return $data;
    }

    /** {@inheritDoc} */
    public function getNodeNameById(string $id): string
    {
        if ($this->hasData()) {
            $data = $this->getData();
            return $data[$id]['feed_category_name'] ?? '';
        }

        return '';
    }

    /**
     * Vrací cestu (breadcrumb) k uzlu podle ID.
     */
    public function getNodePathById(string $id): string
    {
        if ($this->hasData()) {
            $data = $this->getData();
            return $data[$id]['feed_category_path'] ?? '';
        }

        return '';
    }

    /** {@inheritDoc} */
    public function listDropdown(): array
    {
        $out = [];

        if ($this->hasData()) {
            foreach ($this->getData() as $val) {
                $path  = explode('###', $val['feed_category_explode']);
                $root  = trim($path[0]);
                $clean = sprintf('%s ### ', $root);

                $out[$this->filterName($root)][$val['feed_category_id']] =
                    str_replace($clean, '', $val['feed_category_path']);
            }
        }

        return $out;
    }

    /** {@inheritDoc} */
    public function hasData(): bool
    {
        return $this->cacheData !== [];
    }

    /** {@inheritDoc} */
    public function getData(): array
    {
        return $this->cacheData;
    }


    /** {@inheritDoc} */
    public function getAllNodes(): array
    {
        return $this->getData();
    }

    /**
     * Ořeže název kategorie.
     *
     * @param string|null $text
     * @return string
     */
    protected function filterName(?string $text = null): string
    {
        return trim((string) $text);
    }

    /**
     * Vrátí surová CSV data; musí implementovat konkrétní parser.
     *
     * @return array
     */
    abstract public function rawData(): array;
}