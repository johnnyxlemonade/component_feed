<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Zbozi;
use Lemonade\Feed\CsvParser;
use Lemonade\Feed\Helper\HelperString;

/**
 * Class CategoriesHelper
 * @package Lemonade\Feed
 */  
final class ZboziCategories extends CsvParser {
    
    /**
     * Endpoint
     * @var string
     */
    const ENDPOINT_URL = "https://www.zbozi.cz/static/categories.csv";    
     
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
            
            while (($test = \fgetcsv($hand, 1000, ";")) !== FALSE) {
                if (!$first) {
                    
                    $test = \array_map([HelperString::class, "fixUtf8"], $test);
                    
                    $path = \explode(" | ", $test["2"]);
                    $xres = \sprintf("%s", $path["0"]);
                    
                    $data[$this->filterName($test["0"])] = [                        
                        "feed_category_id" => $this->filterName($test["0"]),
                        "feed_category_name" => $this->filterName($test["1"]),
                        "feed_category_main" => $this->filterName($xres),
                        "feed_category_path" => $this->filterName($test["2"]),
                        "feed_category_explode" => \str_replace("|", "###", $this->filterName($test["2"])),
                        "zbozi_hash" => md5(\json_encode($test))
                    ];
                    
                    unset($path);
                    unset($xres);
                }
                
                $first = false;
            }
            
        } catch (\Exception $e) {
            // osetreni vyjimky
        }
        
        return $data;
    }
    


}