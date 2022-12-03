<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Heureka;
use Lemonade\Feed\BaseItem;

/**
 * Class Item
 * @package Lemonade\Feed
 */
final class HeurekaItem extends BaseItem {
    
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
    public $priceVat;
    
    /**
     * @var \DateTime|string
     * @required
     */
    public $deliveryDate = 0;
    
    /**
     * @var string
     * @required
     */
    public $currency = "CZK";
    
    /**
     * DPH
     * @var integer
     */
    protected $vatRate = 21;

    /**
     * Zpusob dopravy a cena
     * @var HeurekaDelivery
     */
    protected $deliveries;
    
    /**
     * Parametry
     * @var HeurekaParameter[]
     */
    protected $parameters = [];
    
    /**
     * Vyrobce
     * @var string|null
     */
    protected $manufacturer;
    
    /**
     * EAN
     * @var string|null
     */
    protected $ean;
    
    /**
     * ISBN
     * @var string|null
     */
    protected $isbn;    
    
    /**
     * Varianty
     * @var string|null
     */
    protected $itemGroupId;
    
    /**
     * Kategorie zbozi
     * @var HeurekaCategoryText[]
     */
    protected $categoryTexts = [];
    
    /**
     * Darky
     * @var HeurekaGift[]
     */
    protected $gifts = [];
    

    
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
     * Nazev produktu
     * @param string $productName
     * @return \Lemonade\Feed\Data\Heureka\HeurekaItem
     */
    public function setProductName(string $productName) {
        
        $this->productName = (string) $productName;
        
        return $this;
    }
    
    /**
     * Vraci nazev produktu
     * @return string
     */
    public function getProductName() {
        
        return $this->productName;
    }
    

    /**
     * Popis produktu
     * @param string $description
     * @return \Lemonade\Feed\Data\Heureka\HeurekaItem
     */
    public function setDescription(string $description = null) {
        
        $this->description = (string) $description;
        
        return $this;
    }
    
    /**
     * Vraci popis nabidky
     * @return string
     */
    public function getDescription() {
        
        return $this->description;
    }   

    /**
     * Produkt url
     * @param string $url
     * @return \Lemonade\Feed\Data\Heureka\HeurekaItem
     */
    public function setUrl(string $url) {
        
        $this->url = (string) $url;
        
        return $this;
    }
    
    /**
     * Vraci URL nabidky
     * @return string
     */
    public function getUrl() {
        
        return $this->url;
    }
    
    /**
     * Nastavi symbol meny
     * @param string $currencySymbol
     * @return \Lemonade\Feed\Data\Heureka\HeurekaItem
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
     * Cena produktu
     * @param mixed $priceVat
     * @return \Lemonade\Feed\Data\Heureka\HeurekaItem
     */
    public function setPriceVat($priceVat) {
        
        $this->priceVat = (float) $priceVat;
        
        return $this;
    }
    
    /**
     * Vraci ciselnou hodnotu nabidky
     * @return float
     */
    public function getPriceVat() {
        
        return $this->priceVat;
    }
    
    /**
     * Nastavi dph
     * @param string $dph
     */
    public function addVatRate(string $dph) {
        
        $this->vatRate = floatval($dph);
        
        return $this;
    }
    
    /**
     * Vraci dph sazbu
     * @return number
     */
    public function getVatRate() {
        
        return $this->vatRate;
    }
    
    
    /**
     * Obrazek produktu
     * @param string $imageUrl
     * @return \Lemonade\Feed\Data\Heureka\HeurekaItem
     */
    public function addImage(string $imageUrl = null) {
        
        $this->images[] = new HeurekaImage($imageUrl);
        
        return $this;
    }

    /**
     * Vraci obrazky
     * @return array|\Lemonade\Feed\Data\Heureka\HeurekaImage[]
     */
    public function getImages() {
        
        return ($this->images ?? []);
    }
      
    /**
     * EAN 
     * @param string $ean
     * @return \Lemonade\Feed\Data\Heureka\HeurekaItem
     */
    public function addEan($ean) {
        
        $this->ean = $ean;
        
        return $this;
    }
    
    /**
     * Vraci EAN carovy kod
     * @return null|string
     */
    public function getEan() {
        
        return $this->ean;
    }
    
    /**
     * ISBN
     * @param string $isbn
     * @return \Lemonade\Feed\Data\Heureka\HeurekaItem
     */
    public function addIsbn(string $isbn = null) {
        
        $this->isbn = $isbn;
        
        return $this;
    }
    
    /**
     * Vraci identifikacni cislo knihy
     * @return null|string
     */
    public function getIsbn() {
        
        return $this->isbn;
    }
    
    /**
     * Vyrobce 
     * @param string $manufacturer
     * @return \Lemonade\Feed\Data\Heureka\HeurekaItem
     */
    public function addManufacturer(string $manufacturer = null) {
        
        $this->manufacturer = $manufacturer;
        
        return $this;
    }    
    
    /**
     * Vrati vyrobce produktu
     * @return null|string
     */
    public function getManufacturer() {
        
        return $this->manufacturer;
    }
   
    /**
     * Nastaveni parametru produktu
     * @param string $name
     * @param string $val
     * @return \Lemonade\Feed\Data\Heureka\HeurekaItem
     */
    public function addParameter($name, $val) {
        
        $this->parameters[] = new HeurekaParameter($name, $val);
        
        return $this;
    }
    
    /**
     * Vraci parametry produktu
     * @return \Lemonade\Feed\Data\Heureka\HeurekaParameter[]
     */
    public function getParameters() {
        
        return $this->parameters;
    }
    
    /**
     * Nastaveni nazvu kategorie podle feedu
     * @param $text
     * @return \Lemonade\Feed\Data\Heureka\HeurekaItem
     */
    public function addCategoryText($text) {
        
        $this->categoryTexts[] = new HeurekaCategoryText($text);
        
        return $this;
    }

    /**
     * Vraci kategorie produktu
     * @return \Lemonade\Feed\Data\Heureka\HeurekaCategoryText[]
     */
    public function getCategoryTexts() {
        
        return $this->categoryTexts;
    }
    
    /**
     * Dodaci doba ve dnech
     * @param string $deliveryDate
     * @throws \InvalidArgumentException
     * @return \Lemonade\Feed\Data\Heureka\HeurekaItem
     */
    public function setDeliveryDate($deliveryDate) {
        
        if (is_int($deliveryDate) || ($deliveryDate instanceof \DateTime)) {
            $this->deliveryDate = $deliveryDate;
        }
        
        return $this;
    }
    
    /**
     * Vraci dodadci dobu
     * @return \DateTime|string
     */
    public function getDeliveryDate() {
        
        return $this->deliveryDate instanceof \DateTime ? $this->deliveryDate->format("Y-m-d") : $this->deliveryDate;
    }
    
    
    /**
     * Zpusob a cena dopravy
     * @param HeurekaDelivery $delivery
     * @return \Lemonade\Feed\Data\Heureka\HeurekaItem
     */
    public function addDelivery(HeurekaDelivery $delivery) {
        
        $this->deliveries[] = $delivery;
        
        return $this;
    }
    
    /**
     * Vraci zpusob a cenu dopravy
     * @return \Lemonade\Feed\Data\Heureka\HeurekaDelivery[]
     */
    public function getDeliveries() {
        
        return ($this->deliveries ?? []);
    }
    
    
    /**
     * Darek k produktu
     * @param HeurekaDelivery $delivery
     * @return \Lemonade\Feed\Data\Heureka\HeurekaItem
     */
    public function addGift(HeurekaGift $gift) {
        
        $this->gifts[] = $gift;
        
        return $this;
    }
    
    /**
     * Vraci darky k produktu
     * @return \Lemonade\Feed\Data\Heureka\HeurekaGift[]
     */
    public function getGift() {
        
        return ($this->gifts ?? []);
    }
    
    /**
     * Oznaceni skupiny nabidek (varianty)
     * @param string $itemGroupId
     * @return \Lemonade\Feed\Data\Heureka\HeurekaItem
     */
    public function addItemGroupId(string $itemGroupId = null) {
        
        $this->itemGroupId = ($itemGroupId <> "" ? mb_substr($itemGroupId, 0, 32) : null);
        
        return $this;
    }
    
    /**
     * Vraci skupiny nabidek
     * @return null|string
     */
    public function getItemGroupId() {
        
        return $this->itemGroupId;
    }
    
    /**
     * 
     * @return string
     */
    public static function getErrorString(): string {        
        return "<?xml version=\"1.0\" encoding=\"UTF-8\"?><SHOP></SHOP>";
    }
  
    
    
    
}