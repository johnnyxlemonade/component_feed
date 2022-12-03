<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Google;
use Lemonade\Feed\CsvParser;
use Lemonade\Feed\Helper\HelperString;

/**
 * Class CategoriesHelper
 * @package Lemonade\Feed
 */ 
final class GoogleCategories extends CsvParser {

    /**
     * Endpoint
     * @var string
     */
    const ENDPOINT_URL = "https://www.google.com/basepages/producttype/taxonomy-with-ids.cs-CZ.txt";
    
    /**
     *
     * {@inheritDoc}
     * @see \Lemonade\Feed\ParserInterface::getUrl()
     */
    public function getUrl(): string {
        return self::ENDPOINT_URL;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Lemonade\Feed\ParserInterface::rawData()
     */
    public function rawData() {
        
        $data = [];
        
        try {
            
            $first = true;
            $hand = \fopen($this->cacheUrl, "r");
            
            
            while (($line = fgets($hand, 1000)) !== false) {
                if (!$first) {
                    
                    $tmp = \array_map([HelperString::class, "fixUtf8"], [$line]);
                    $tmp = \explode(" - ", $line);
                    
                    if(\strpos($line, ">") !== FALSE) {
                        
                        $path = \explode(" > ", $tmp[1]);
                        
                        $data[$this->filterName($tmp["1"])] = [
                            "feed_category_id" => $tmp[0],
                            "feed_category_name" => $this->filterName(\end($path)),
                            "feed_category_main" => $this->filterName($path[0]),
                            "feed_category_path" => $this->filterName($tmp[1]),
                            "feed_category_explode" => \str_replace(">", "###", $this->filterName($tmp["1"])),
                        ];
                        
                    } else {
                        
                        $data[$this->filterName($tmp["1"])] = [
                            "feed_category_id" => $tmp[0],
                            "feed_category_name" => $this->filterName($tmp[1]),
                            "feed_category_main" => NULL,                            
                            "feed_category_path" => $this->filterName($tmp[1]),
                            "feed_category_explode" => $this->filterName($tmp[1]),
                        ];
                    }
                    
                    
                }
                
                $first = false;
            }
            
            
        } catch (\Exception $e) {
            // osetreni vyjimky
        }
        
        return $data;
    }
    
    
}