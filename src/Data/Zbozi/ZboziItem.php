<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Zbozi;
use Lemonade\Feed\BaseItem;

/**
 * Class Item
 * @package Lemonade\Feed
 */
final class ZboziItem extends BaseItem {
    
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
     * @var \DateTime|int
     */
    public $deliveryDate = 0;
    
    /**
     * @var string
     * @required
     */
    public $currency = "CZK";

    
    #recommended
    /** @var ZboziDelivery[] */
    protected $deliveries;
            
    /** @var ZboziImage[] */
    protected $images;
    
    /** @var string|null */
    protected $ean;
    
    /** @var string|null */
    protected $isbn;
    
    /** @var string|null */
    protected $productNo;
    
    /** @var string|null */
    protected $itemGroupId;
    
    /** @var string|null */
    protected $manufacturer;
    
    #optional
    /** @var string|null */
    protected $brand;
    
    /** @var int|null */
    protected $categoryId;
    
    /** @var ZboziCategoryText[] */
    protected $categoryTexts = [];
    
    /** @var string|null */
    protected $product;
    
    /** @var string|null */
    protected $itemType = "new";
    
    /** @var ZboziExtraMessage[] */
    protected $extraMessages;
    
    /** @var ZboziShopDepot[] */
    protected $shopDepots;
    
    /** @var bool */
    protected $visibility = true;
    
    /** @var ZboziParameter[] */
    protected $parameters = [];
    

    #product database
    /** @var string|null */
    protected $productLine;
    
    /** @var float|null */
    protected $listPrice;
    
    /** @var \DateTime|null */
    protected $releaseDate;
    
    
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
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
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
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
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
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
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
     * Cena produktu
     * @param mixed $priceVat
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
     */
    public function setPriceVat(string|int|float $priceVat) {
        
        $this->priceVat = (float) $priceVat;
        
        return $this;
    }
    
    /**
     * Vraci ciselnou hodnotu nabidky
     * @return float
     */
    public function getPriceVat(): float {
        
        return $this->priceVat;
    }
    
    /**
     * Dostupnost
     * @param string $deliveryDate
     * @throws \InvalidArgumentException
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
     */
    public function setDeliveryDate($deliveryDate) {
        
        if (is_int($deliveryDate) || ($deliveryDate instanceof \DateTime)) {
            $this->deliveryDate = $deliveryDate;
        }

        return $this;
    }

    /**
     * Vraci dostupnost
     * @return \DateTime|string
     */
    public function getDeliveryDate() {
        
        return $this->deliveryDate instanceof \DateTime ? $this->deliveryDate->format("Y-m-d") : $this->deliveryDate;
    }

    /**
     * Obrazek produktu
     * @param string $imageUrl
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
     */
    public function addImage(string $imageUrl = null) {
        
        $this->images[] = new ZboziImage($imageUrl);
        
        return $this;
    }

    /**
     * Vraci obrazky
     * @return array|\Lemonade\Feed\Data\Zbozi\ZboziImage[]
     */
    public function getImages() {
        
        return ($this->images ?? []);
    }
         
    /**
     * Nastavi produkt (pro vyhledavani)
     * @param string $product
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
     */
    public function addProduct(string $product) {
        
        $this->product = mb_substr($product, 0, 64);
        
        return $this;
    }
    
    /**
     * Vraci nazev ve vyslednich vyhledavani
     * @return string|NULL
     */
    public function getProduct() {
        
        return $this->product;
    }
    
    /**
     * Doporucena cena
     * @param mixed $listPrice
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
     */
    public function addListPrice($listPrice) {
        
        $this->listPrice = (is_null($listPrice) ? null : floatval($listPrice));
        
        return $this;
    }
    
    /**
     * Vraci doporucenou koncovou prodejni cenu
     * @return mixed
     */
    public function getListPrice() {
        
        return $this->listPrice;
    }
 
    /**
     * Vraci produktovou radu
     * @return mixed
     */
    public function getProductLine() {
        
        return $this->productLine;
    }
    
    /**
     * Nastavuje produktovou radu
     * @param mixed $productLine
     * @return ZboziItem
     */
    public function addProductLine($productLine) {
        
        $this->productLine = $productLine;        
        
        return $this;
    }
        
    /**
     * Zacatek prodeje
     * @param \DateTime $releaseDate
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
     */
    public function setReleaseDate(\DateTime $releaseDate) {
        
        $this->releaseDate = $releaseDate;
        
        return $this;
    }
        
    /**
     * Vraci datum oficialniho zahajeni v CR
     * @return mixed
     */
    public function getReleaseDate() {
        
        return $this->releaseDate;
    }


    /**
     * EAN 
     * @param string $ean
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
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
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
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
     * Produktove cislo vyrobce
     * @param string $productNo
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
     */
    public function addProductNo(string $productNo = null) {
        
        $this->productNo = $productNo;
        
        return $this;
    }
    
    /**
     * Vraci produktove cislo vyrobce
     * @return null|string
     */
    public function getProductNo() {
        
        return $this->productNo;
    }

    /**
     * Oznaceni skupiny nabidek (varianty)
     * @param string $itemGroupId
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
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
     * Vyrobce 
     * @param string $manufacturer
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
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
     * Znacka produktu
     * @param string $brand
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
     */
    public function addBrand($brand) {
        
        $this->brand = $brand;
        
        return $this;
    }
    
    /**
     * Vraci znacku produktu
     * @return null|string
     */
    public function getBrand() {
        
        return $this->brand;
    }
       
    /**
     * Nastavi ID kategorie z feed kategorii
     * @param int|null $categoryId    
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
     */
    public function addCategoryId($categoryId) {
        
        $this->categoryId = $categoryId;
        
        return $this;
    }
    
    /**
     * Vraci id kategorie z feed kategorie
     * @return int|null
     */
    public function getCategoryId() {
        return $this->categoryId;
    }
    
    /**
     * Nastaveni nazvu kategorie podle feedu
     * @param $text
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
     */
    public function addCategoryText($text) {
        
        $this->categoryTexts[] = new ZboziCategoryText($text);
        
        return $this;
    }
    
    /**
     * Nastaveni Id kategorie podle feedu
     * @return null|string
     */
    public function getCategoryTexts() {
        
        return $this->categoryTexts;
    }
    
    /**
     * @return null|string
     */
    public function getItemType() {
        
        return $this->itemType;
    }
    

    /**
     * Zobrazeni nabidky na zbozi.cz
     * @param boolean $visibility
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
     */
    public function addVisibility($visibility) {
        
        $this->visibility = $visibility;
        
        return $this;
    }    
    
    /**
     * @return boolean
     */
    public function isVisibility() {
        
        return $this->visibility;
    }    

    /**
     * Pridat doplnkovou informaci o nabidce
     * @param string $type
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
     */
    public function addExtraMessage($type) {
        
        $this->extraMessages[] = new ZboziExtraMessage($type);
        
        return $this;
    }
         
    /**
     * Vraci doplnkove informace o nabidce
     * @return \Lemonade\Feed\Data\Zbozi\ZboziExtraMessage[]
     */
    public function getExtraMessages() {
        
        return $this->extraMessages;
    }
        
    /**
     * Nastaveni parametru nabidky
     * @param string $name
     * @param string $val
     * @param string $unit
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
     */
    public function addParameter($name, $val, $unit = null) {
        
        $this->parameters[] = new ZboziParameter($name, $val, $unit);
        
        return $this;
    }

    /**
     * Vraci parametry nabidky
     * @return \Lemonade\Feed\Data\Zbozi\ZboziParameter[]
     */
    public function getParameters() {
        
        return $this->parameters;
    }
    
    /**
     * Nastaveni dopravce a sit vydejnich mist
     * @param ZboziDelivery $delivery
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
     */
    public function addDelivery(ZboziDelivery $delivery) {
        
        $this->deliveries[] = $delivery;      
        
        return $this;
    }

    /**
     * kontrola na vyplnene dopravce
     * @return \Lemonade\Feed\Data\Zbozi\ZboziDelivery[]
     */
    public function getDeliveries() {
        
        return ($this->deliveries ?? []);
    }
    
    /**
     * Nastavi symbol meny
     * @param string $currencySymbol
     * @return \Lemonade\Feed\Data\Zbozi\ZboziItem
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
     * 
     * @return string
     */
    public static function getErrorString(): string {        
        return "<?xml version=\"1.0\" encoding=\"UTF-8\"?><SHOP xmlns=\"http://www.zbozi.cz/ns/offer/1.0\"></SHOP>";
    }
  
    
    
    
}