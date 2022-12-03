<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\OpenSearch;

/**
 * OpenSearchImage
 * @package Lemonade\Feed
 */ 
class OpenSearchImage {

    /**
     * Obrazek
     * @var string
     */
    private $path;

    /**
     * Image constructor.
     * @param $url
     */
    public function __construct(string $url = null) {
        
        $this->path = $url;       
    }
           
    
    /**
     * Obrazek
     * @return string
     */
    public function getPath() {
        
        return $this->path;
    }
    
    
    /**
     * Vraci url
     * @return null|string
     */
    public function getUrl() {
       
        if($this->path && file_exists($this->path) && is_file($this->path)) {
            return $this->_getEncodedExtension() . base64_encode(file_get_contents($this->path));
        }
        
        return null;
    }
    
    /**
     * Extenze
     * @return string
     */
    protected function _getEncodedExtension() {
        
        switch(pathinfo($this->path, PATHINFO_EXTENSION)) {
            case "jpg":
            case "jpeg":
                return "data:image/jpg;base64,";
            break;
            case "gif":
                return "data:image/gif;base64,";
            break;
            case "png":
            default:
                return "data:image/png;base64,";
            break;
        }       
    }

}
