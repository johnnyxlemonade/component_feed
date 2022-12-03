<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\OpenSearch;
use Lemonade\Feed\BaseItem;

/**
 * OpenSearchItem
 * @package Lemonade\Feed
 * @see https://www.sitemaps.org/protocol.html
 */  
final class OpenSearchItem extends BaseItem {
    
    #required
    /**
     * @var string|null
     * @required
     */
    public $itemId;
    
    /** 
     * @var string 
     * @required
     */
    public $shortName;
    
    /** 
     * @var string 
     * @required
     */
    public $longName;

    /**
     * @var string
     * @required
     */
    public $url;
    
    /**
     * @var string|null
     * @required
     */
    public $description;    
    
    #recommended        
    /** @var string|null */
    protected $contact = "core1@core1.agency";
    
    /**
     * obrazek
     * @var OpenSearchImage
     */
    protected $image;
    
    /** @var string|null */
    protected $outputEncoding = "UTF-8";
    
    /** @var string|null */
    protected $inputEncoding = "UTF-8";
    
    
    public function __construct(string $itemId) {
        $this->itemId = $itemId;
    }
    
    public function getItemId() {
        return $this->itemId;
    }
    
    public function setShortName(string $shortname) {
        $this->shortName = (string) $shortname;
    }
    
    public function getShortName() {
        return $this->shortName;
    }
    
    public function setUrl(string $url) {
        $this->url = (string) $url;
    }
    
    public function getUrl() {
        return $this->url;
    }
    
    public function setLongName(string $longName) {
        $this->longName = (string) $longName;
    }
    
    public function getLongName() {
        return $this->longName;
    }
    
    public function setDescription(string $description) {
        $this->description = (string) $description;
    }
    
    public function getDescription() {
        
        return $this->description;
    }
    
    public function addImage(string $image = null) {
        
        $this->image = new OpenSearchImage($image);
        
        return $this;
    }
    
    public function getImage() {
                
        return $this->image;
    }
    
    public function getContact() {
        
        return $this->contact;
    }
    
    public function getInputEncoding() {
        
        return $this->inputEncoding;
    }
    
    public function getOutputEncoding() {
        
        return $this->outputEncoding;
    }
    
    public static function getErrorString(): string {
        
        return "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
    }


  
    
}
