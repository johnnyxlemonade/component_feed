<?php declare(strict_types = 1);

namespace Lemonade\Feed;
use Latte\Engine;

/**
 * Class BaseGenerator
 * @package Lemonade\Feed
 */
abstract class BaseGenerator implements GeneratorInterface {

    /**
     * Sablona
     */
    private $fileExtension = ".latte"; 
    
    /**
     * Vystup
     * @var string
     */
    private $outputMime = "application/html";
    
    /**
     * Zpracovani
     * @var bool
     */
    private $prepared = false;
    
    /**
     * tmp 
     * @var resource|bool|null
     */
    private $handle;

    /**
     * Uloziste
     * @var BaseStorage
     */
    private $storage;
    
    /**
     * Hostitel
     * @var string|null
     */
    private $appHost;
    
    /**
     * Nazev webu
     * @var string
     */
    private $appName;

    
    /**
     * BaseGenerator constructor
     * @param BaseStorage $storage
     * @param string $dataHost
     * @param string $appName
     */
    public function __construct(BaseStorage $storage, string $appHost = null, string $appName = null, protected readonly Engine $engine = new Engine()) {
        
        $this->storage = $storage;
        $this->appHost = (string) $appHost;
        $this->appName = (string) $appName;    
    }
    
    
    /**
     * Hostitel
     * @return string
     */
    public function getAppHost(): string
    {

        return ($this->appHost ?? $_SERVER["HTTP_HOST"] ?? "local");
    }
    
    /**
     * Nazev
     * @return string
     */
    public function getAppName(): string
    {

        return ($this->appName ?? "");
    }

    /**
     * Sablona
     * @param string 
     */
    abstract protected function getTemplate($name);
    
    /**
     * Hlavicky
     */
    abstract protected function pushHeaders();
    
    /**
     * Error string
     */
    abstract protected function getErrorString();
    

    /**
     * Pripravit temp soubor
     */
    protected function prepareTmpFile() {
        
        $this->handle = tmpfile();
        $this->prepareTemplate("header", true);
        $this->prepared = true;
    }

    /**
     * Pripraveni sablony
     * @param $template
     */
    protected function prepareTemplate($template) {
        
        $file = $this->getTemplate($template);
        
        if($template === "header") {
            
            $latte = new Engine;
            $string = $latte->renderToString($file, [
                "generator" => __NAMESPACE__, 
                "host" => $this->getAppHost(),
                "name" => $this->getAppName(),
                "time" => time()                
            ]);
            
        } else {
            
            $handle = fopen($file, "r");
            $string = fread($handle, filesize($file));
            fclose($handle);
        }

        fwrite($this->handle, $string);        
    }
    
    
    /**
     * Vraci typ sablony
     * @return string
     */
    protected function getExtension(): string
    {

        return $this->fileExtension;
    }
    
    
    /**
     * Ulozeni do souboru
     * @param string $filename
     * @param string $callback
     */
    protected function writeFile(string $filename = null, string $callback = null) {
     
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
                                          
            fclose($this->handle);
                                
            $this->prepared = false;
            
            return $data;
        }
    }
    
    /**
     * XML
     * @param string $content
     * @return string
     */
    protected function _formatXml(string $content = null) {
        
        $dom = new \DOMDocument("1.0");
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($content);
        
        return $dom->saveXML();
    }
    
    
    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\GeneratorInterface::addItem()
     */
    public function addItem(ItemInterface $item) {


        if (!$this->prepared) {

            $this->prepareTmpFile();
        }

        if ($item->validate()) {

            $xmlItem = $this->engine->renderToString($this->getTemplate("item"), ["item" => $item]);

            fwrite($this->handle, $xmlItem);

            unset($xmlItem);
        } 
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\GeneratorInterface::output()
     */
    public function output(string $callback = null) {

        $this->pushHeaders();
        
        exit((empty($data = $this->writeFile(null, $callback)) ? $this->getErrorString() : $data));
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\GeneratorInterface::save()
     */
    public function save(string $filename = null, string $callback = null) {
        
        return $this->writeFile($filename, $callback);
    }

}