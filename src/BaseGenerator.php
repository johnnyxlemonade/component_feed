<?php declare(strict_types = 1);

namespace Lemonade\Feed;

use Latte\Engine;

/**
 * BaseGenerator
 *
 * Abstraktní generátor výstupních souborů (např. XML feed) pomocí Latte šablon.
 *
 * • Používá `tmpfile()` pro sestavení výstupu
 * • Generuje výstup skrze šablony `header`, `item`, `footer`
 * • Umožňuje uložení do souboru nebo přímý výstup s MIME headerem
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrak <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
abstract class BaseGenerator implements GeneratorInterface
{
    /**
     * Přípona šablony (default: .latte)
     */
    private string $fileExtension = '.latte';

    /**
     * MIME typ výstupu (např. application/xml, application/html)
     */
    private string $outputMime = 'application/html';

    /**
     * Flag – připravenost výstupního souboru
     */
    private bool $prepared = false;

    /**
     * Handle na dočasný výstupní soubor
     *
     * @var resource|false|null
     */
    private $handle;

    /**
     * Latte engine pro generování šablon
     */
    public function __construct(
        protected readonly BaseStorage $storage,
        protected readonly Engine $engine = new Engine(),
        protected readonly ?string $appHost = null,
        protected readonly ?string $appName = null,
    ) {}

    /**
     * Nastaví výstupní hlavičky pro XML soubor.
     */
    protected function pushHeaders(): void
    {
        header_remove();
        header('Content-type: application/xml');
    }

    /**
     * Vrací chybovou hlášku při selhání výstupu.
     */
    protected function getErrorString(): string
    {
        return \str_replace(
            ['{name}', '{url}'],
            [$this->getAppName(), $this->getAppHost()],
            $this->getItemClass()::getErrorString()
        );
    }

    /**
     * Inicializuje výstupní stream a vygeneruje hlavičku.
     */
    protected function prepareTmpFile(): void
    {
        $this->handle = tmpfile();
        $this->prepareTemplate('header');
        $this->prepared = true;
    }

    /**
     * Připraví šablonu (header = Latte, ostatní = raw soubory) a zapíše ji do výstupu.
     *
     * @param string $template Název šablony (např. "header", "item", "footer")
     * @return void
     */
    protected function prepareTemplate(string $template): void
    {
        $file = $this->getTemplate($template);

        if ($template === 'header') {
            $string = $this->engine->renderToString($file, $this->getHeaderTemplateVars());
            fwrite($this->handle, $string);

        } else {
            $handle = fopen($file, 'r');
            while (!feof($handle)) {
                fwrite($this->handle, fread($handle, 8192));
            }
            fclose($handle);
        }
    }

    /**
     * Vrací příponu šablon.
     */
    protected function getExtension(): string
    {
        return $this->fileExtension;
    }

    /**
     * Zpracuje a zapíše výstup do souboru nebo vrátí jako string.
     */
    protected function writeFile(string $filename = null, ?string $callback = null) {
     
        if ($this->prepared) {
            
            $this->prepareTemplate("footer");
            
            $size = ftell($this->handle);
            
            rewind($this->handle);
        
            $data = fread($this->handle, $size);
            
            // callback
            if(!empty($callback) && \method_exists($this, $callback)) {
                $data = $this->$callback($data);
            }
            
            // ukladame
            if(!empty($filename)) {
                $data = $this->storage->save($filename, $data);                
            }

            // fail safe close
            if (is_resource($this->handle)) {
                fclose($this->handle);
            }

            $this->prepared = false;
            
            return $data;
        }
    }
    
    /**
     * XML
     */
    protected function _formatXml(?string $content = null): string
    {
        if ((string) $content === "") {
            return "";
        }

        libxml_use_internal_errors(true);

        $dom = new \DOMDocument("1.0");
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;

        $ok = $dom->loadXML($content);
        libxml_clear_errors();

        return $ok ? $dom->saveXML() : '';
    }

    /**
     * Vrací aktuální hostitele aplikace (s preferencí ENV proměnných).
     *
     * Priority:
     *  1. Vlastní hodnota z konstruktoru ($appHost)
     *  2. ENV proměnná APP_HTTP_HOST
     *  3. Serverová proměnná HTTP_HOST
     *  4. Výchozí hodnota "local"
     *
     * @return string
     */
    public function getAppHost(): string
    {
        return $this->appHost
            ?? ($_ENV['APP_HTTP_HOST'] ?? null)
            ?? ($_SERVER['HTTP_HOST'] ?? 'local');
    }

    /**
     * Vrací název webu/aplikace.
     */
    public function getAppName(): string
    {
        return $this->appName ?? '';
    }

    /**
     * {@inheritdoc}
     */
    public function addItem(ItemInterface $item): void
    {
        if (!$this->prepared) {
            $this->prepareTmpFile();
        }

        if ($item->validate()) {
            $xml = $this->engine->renderToString($this->getTemplate('item'), ['item' => $item]);
            fwrite($this->handle, $xml);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function output(string $callback = null): void
    {
        $this->pushHeaders();
        exit($this->writeFile(null, $callback) ?: $this->getErrorString());
    }

    /**
     * {@inheritdoc}
     */
    public function save(string $filename = null, string $callback = null)
    {
        return $this->writeFile($filename, $callback);
    }

    /**
     * Vrací cestu k šabloně.
     */
    protected function getTemplate(string $name): string
    {
        $path = dirname((new \ReflectionClass($this))->getFileName()) . '/latte/' . $name . $this->getExtension();

        if (!is_file($path)) {
            throw new \RuntimeException("Šablona '$name' nenalezena: $path");
        }

        return $path;
    }

    protected function getHeaderTemplateVars(): array
    {
        return [
            'generator' => __NAMESPACE__,
            'host'      => $this->getAppHost(),
            'name'      => $this->getAppName(),
            'time'      => time(),
        ];
    }

    /**
     * Vrací plně kvalifikovaný název třídy
     */
    abstract protected function getItemClass(): string;

    /**
     * Uvolnění zdrojů
     */
    public function __destruct()
    {
        if (is_resource($this->handle)) {
            fclose($this->handle);
        }
    }


}