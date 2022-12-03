<?php declare(strict_types = 1);

namespace Lemonade\Feed;

use Lemonade\Feed\Cache\FileSystem;

/**
 * Class CsvDownloader
 * @package Lemonade\Feed
 */
abstract class CsvParser implements ParserInterface {
        
    /**
     * Cas kesovani
     * @var number
     */
    protected $cacheTime = 2592000;
    
    /**
     * Nazev souboru
     * @var string
     */
    protected $cacheFile = "download-file"; 
    
    /**
     * Data
     * @var array
     */
    protected $cacheData = [];
    
    /**
     * Endpoint url
     * @var string
     */
    protected $cacheUrl = null;
    
    /**
     * CsvDownloader
     * @param string $endpointUrl
     * @param bool $forceDownload
     */
    public function __construct(string $endpointUrl, bool $forceDownload = true) {
        
        $this->cacheUrl  = $endpointUrl;
        $this->cacheData = ($forceDownload ? $this->downloadData() : []);
        
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\ParserInterface::downloadData()
     */
    public function downloadData() {
        
        try {
            
            $cache = FileSystem::getInstance($this->cacheUrl, true);
            $data = $cache->load($cache->getFileId(), $this->cacheTime);
            
            if(!$data) {
                
                return $cache->save($cache->getFileId(), $this->rawData());
            }
            
            return $data;
            
        } catch (\Exception $e) {
            // osetreni vyjimky
        }
        
        return false;
    }

    
    /**
     * Vraci hlavni kategorie
     * @return array
     */
    public function getMainNodes(): array {
        
        $data = [];
                
        if(!empty($test = $this->listDropdown())) {
           
            foreach (\array_keys($test) as $name) {
                $data[$name] = \sprintf("%s [%d]", $name, \count($test[$name]));
            }
        }
        
        return $data;
    }

    
    /**
     *
     * {@inheritDoc}
     * @see \Lemonade\Feed\ParserInterface::getNodeArrayByName()
     */
    public function getNodeArrayByName(array $name): array {
        
        $test = $this->listDropdown();
        $data = [];
        
        if(!empty($test)) {
            foreach(\array_keys($test) as $cat) {
                if(\in_array($cat, $name)) {
                    
                    $data[$cat] = $test[$cat];
                }
            }
        }
        
        return $data;
    }
        
    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\ParserInterface::getNodeNameById()
     */
    public function getNodeNameById(string $id): string {
        
        if($this->hasData()) {
            
            $data = $this->getData();
            
            return ($data[$id]["feed_category_name"] ?? "");
        }
        
        return "";
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \Lemonade\Feed\ParserInterface::getNodeNameById()
     */
    public function getNodePathById(string $id): string {
        
        if($this->hasData()) {
            
            $data = $this->getData();
            
            return ($data[$id]["feed_category_path"] ?? "");
        }
        
        return "";
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\ParserInterface::listDropdown()
     */
    public function listDropdown(): array {
        
        $data = [];
        
        if($this->hasData()) {
            foreach($this->getData() as $val) {
                                
                $path = \explode("###", $val["feed_category_explode"]);
                $xres = \sprintf("%s ### ", $path["0"]);
                
                $data[$this->filterName($path["0"])][$val["feed_category_id"]] = \str_replace($xres, "", $val["feed_category_path"]);
            }
        }
        
        return $data;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\ParserInterface::hasData()
     */
    public function hasData(): bool {
    
        if($this->cacheData) {
            return (\count($this->cacheData) > 0);
        }
        
        return false;        
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\ParserInterface::getData()
     */
    public function getData(): array {

        if(\is_array($this->cacheData)) {
            return $this->cacheData;
        }
        
        return [];
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\ParserInterface::getAllNodes()
     */
    public  function getAllNodes(): array {
        
        return $this->getData();
    }

    
    /**
     * Nazev filtr
     * @param string $text
     * @return string
     */
    protected function filterName(string $text = null): string {
        return \trim($text);
    }

}