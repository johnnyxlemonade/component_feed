<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Google;
use Lemonade\Feed\BaseItem;

/**
 * GoogleItem
 * @package Lemonade\Feed
 * @see https://support.google.com/merchants/answer/7052112?hl=cs
 */  
final class GoogleItem extends BaseItem {
    
    const CONDITION_NEW = "new";
    const CONDITION_REFURBISHED = "refurbished";
    const CONDITION_USED = "used";    
    const AVAILABILITY_PREORDER = "preorder";
    const AVAILABILITY_IN_STOCK = "in stock";
    const AVAILABILITY_OUT_OF_STOCK = "out of stock";
    
    /**
     * Typ
     * @var array
     */
    private static $conditions = [
        self::CONDITION_NEW,
        self::CONDITION_REFURBISHED,
        self::CONDITION_USED,
    ];
    
    /**
     * Dostupnost
     * @var array
     */
    private static $availabilities = [
        self::AVAILABILITY_PREORDER,
        self::AVAILABILITY_IN_STOCK,
        self::AVAILABILITY_OUT_OF_STOCK,
    ];
        
    /**
     * @var string|null
     * @required
     */
    public $itemId;
    
    /**
     * @var string
     * @required
     */
    public $productName;
    
    /**
     * @var string
     * @required
     */
    public $description;
    
    /**
     * @var string
     * @required
     */
    public $url;
    
    /**
     * @var float
     * @required
     */
    public $price;
    
    /**
     * @var string
     * @required
     */
    public $currency = "CZK";
    
    /** @var GoogleDelivery[] */
    protected $deliveries;
    
    /** @var GoogleImage[] */
    protected $images = [];    

    /** @var string */
    protected $availability = self::AVAILABILITY_IN_STOCK;
    
    /** @var string */
    protected $condition = self::CONDITION_NEW;
    
    /** @var string */
    protected $salePrice;
    
    /** @var \DateTime|null */
    protected $availabilityDate;
        
    /** @var string */
    protected $gtin;
    
    /** @var string */
    protected $mpn;
    
    /** @var string */
    protected $brand;
    
    /** @var bool */
    protected $identifierExists;
        
    /** @var string */
    protected $itemGroupId;
    
    /** @var string|null */
    protected $googleProductCategory;
    
    /** @var GoogleProductType[] */
    protected $productTypes = [];


    /**
     * 
     * @param string|int $itemId
     */
    public function __construct(string|int $itemId) {
        
        $this->itemId = $itemId;
    }
    
    /**
     * Vraci itemId
     * @return string
     */
    public function getItemId(): ?string {
        
        return (string) $this->itemId;
    }
      

    /**
     * Nastavi nazev polozky
     * @param string $title
     * @return \Lemonade\Feed\Data\Google\GoogleItem
     */
    public function setProductName(string $title) {
        
        $this->productName = $title;        
        
        return $this;
    }

    /**
     * Vraci nazev polozky
     * @return string
     */
    public function getProductName() {
        
        return $this->productName;
    }
    
    /**
     * Nastavi popisek polozky
     * @param string $description
     * @return \Lemonade\Feed\Data\Google\GoogleItem
     */
    public function setDescription(string $description) {
        
        $this->description = $description;
        
        return $this;
    }
    
    /**
     * Vraci popis polozky
     * @return string
     */
    public function getDescription() {
        
        return $this->description;
    }
    
    /**
     * Nastavi url
     * @param string $url
     * @return \Lemonade\Feed\Data\Google\GoogleItem
     */
    public function setUrl(string $url) {
        
        $this->url = $url;
        
        return $this;
    }
    
    /**
     * Vraci url polozky
     * @return string
     */
    public function getUrl() {
        
        return $this->url;
    }

    /**
     * Nastavi obrazek
     * @param string $url
     * @return \Lemonade\Feed\Data\Google\GoogleItem
     */
    public function addImage(string $url) {
        
        $this->images[] = new GoogleImage($url);
        
        return $this;
    }
    
    /**
     * Vraci obrazek
     * @return \Lemonade\Feed\Data\Google\GoogleImage[]
     */
    public function getImages() {
        
        return $this->images;
    }
    
    /**
     * Nastavi cenu
     * @param int|float $price
     * @return \Lemonade\Feed\Data\Google\GoogleItem
     */
    public function setPrice($price) {
        
        $this->price = (float) $price;
        
        return $this;
    }
    
    /**
     * Vraci cenu
     * @return number
     */
    public function getPrice() {
        
        return $this->price;
    }
    
    /**
     * Nastavi symbol meny
     * @param string $currencySymbol
     * @return \Lemonade\Feed\Data\Google\GoogleItem
     */
    public function setCurrency(string $currencySymbol) {
        
        $this->currency = $currencySymbol;
        
        return $this;
    }
    
    /**
     * Vraci symbol meny
     * @return string
     */
    public function getCurrency() {
        
        return $this->currency;
    }
    
    
    /**
     * Nastavi dostupnost
     * @param string $availability
     * @return \Lemonade\Feed\Data\Google\GoogleItem
     */
    public function setAvailability(string $availability) {
        
        if (in_array($availability, self::$availabilities)) {
            $this->availability = $availability;
            
        }
      
        return $this;
    }

    /**
     * Vraci dostupnost
     * @return string
     */
    public function getAvailability() {
        
        return $this->availability;
    }
    
    
    /**
     * Nastavi stav polozky
     * @param string $condition
     * @return \Lemonade\Feed\Data\Google\GoogleItem
     */
    public function setCondition($condition) {
        
        if (in_array($condition, self::$conditions)) {
            $this->condition = $condition;
        }

                
        return $this;
    }
    
    /**
     * Vraci stav polozky
     * @return string
     */
    public function getCondition() {
        
        return $this->condition;
    }
    

    /**
     * Nastavuje datum, kdy bude produkt k dispozici pro dodání
     * @param \DateTime $availabilityDate
     * @return \Lemonade\Feed\Data\Google\GoogleItem
     */
    public function addAvailabilityDate(\DateTime $availabilityDate = null) {
        
        $this->availabilityDate = $availabilityDate;        
        
        return $this;
    }
    
    /**
     * Vraci dostupnost
     * @return \DateTime|NULL
     */
    public function getAvailabilityDate() {
        
        return $this->availabilityDate instanceof \DateTime ? $this->availabilityDate->format("c") : $this->availabilityDate;
    }
        

    /**
     * Nastavi GTIN (global trade item number)
     * @param string $gtin
     * @return \Lemonade\Feed\Data\Google\GoogleItem
     */
    public function addGtin(string $gtin) {
        
        $this->gtin = (string) $gtin;
        
        return $this;
    }
     
    /**
     * Vraci gtin
     * @return string
     */
    public function getGtin() {
        
        return $this->gtin;
    }   
    
    /**
     * NPM
     * @param string $mpn
     * @return \Lemonade\Feed\Data\Google\GoogleItem
     */
    public function addMpn(string $mpn = null) {
        
        $this->mpn = $mpn;
        
        return $this;
    }

    /**
     * NPM
     * @return string
     */
    public function getMpn() {
        
        return $this->mpn;
    }
    
    /**
     * Znacka
     * @param string $brand
     * @return \Lemonade\Feed\Data\Google\GoogleItem
     */
    public function addBrand(string $brand = null) {
        
        $this->brand = $brand;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getBrand() {
        
        return $this->brand;
    }
        

    /**
     * Cena v akci
     * @param string $salePrice
     * @return \Lemonade\Feed\Data\Google\GoogleItem
     */
    public function setSalePrice($salePrice) {
        
        $this->salePrice = $salePrice;       
        
        return $this;
    }
    
    /**
     * Vraci cenu v akci
     * @return string
     */
    public function getSalePrice() {
        
        return $this->salePrice;
    }
    
    /**
     * identifikator
     * @return boolean
     */
    public function isIdentifierExists() {
        
        return $this->identifierExists;
    }
    
    /**
     * Identifikator
     * @param string $identifierExists
     * @return \Lemonade\Feed\Data\Google\GoogleItem
     */
    public function setIdentifierExists($identifierExists) {
        
        $this->identifierExists = $identifierExists;
        
        return $this;
    }
    
    
    /**
     * Kategorie polozky (vlastni)
     * @param string $text
     * @return \Lemonade\Feed\Data\Google\GoogleItem
     */
    public function addProductType($text) {
        
        $this->productTypes[] = new GoogleProductType($text);   
        
        return $this;
    }
    
    
    /**
     * Vraci seznam kategorii
     * @return \Lemonade\Feed\Data\Google\GoogleProductType[]
     */
    public function getProductTypes() {
        
        return $this->productTypes;
    }
        

    /**
     * Google kategorie
     * @param string $googleProductCategory
     * @return \Lemonade\Feed\Data\Google\GoogleItem
     */
    public function setGoogleProductCategory($googleProductCategory) {
        
        $this->googleProductCategory = $googleProductCategory;
        
        return $this;
    }

    /**
     * Vraci google kategorie
     * @return string|NULL
     */
    public function getGoogleProductCategory() {
        
        return $this->googleProductCategory;
    }
        
    
    /**
     * Varianty polozky
     * @param string $itemGroupId
     */
    public function addItemGroupId(string $itemGroupId) {
        
        $this->itemGroupId = $itemGroupId;
        
        return $this;
    }
    
    
    /**
     * Vraci varianty
     * @return string
     */
    public function getItemGroupId() {
        
        return $this->itemGroupId;
    }
    
    
    /**
     * Dopravce a sit vydejnich mist
     * @param GoogleDelivery $delivery
     * @return \Lemonade\Feed\Data\Google\GoogleItem
     */
    public function addDelivery(GoogleDelivery $delivery) {
        
        $this->deliveries[] = $delivery;
        
        return $this;
    }

    /**
     * Kontrola na vyplnene dopravce
     * @return array|\Lemonade\Feed\Data\Google\GoogleDelivery[]
     */
    public function getDeliveries() {
        
        return ($this->deliveries ?? []);
    }

    /**
     * Error
     * @return string
     */
    public static function getErrorString(): string {
       
        return "<?xml version=\"1.0\" encoding=\"UTF-8\"?><rss xmlns:g=\"http://base.google.com/ns/1.0\" version=\"2.0\"><channel><title>{name}</title><link>{url}</link></channel></rss>";
    }
 
}