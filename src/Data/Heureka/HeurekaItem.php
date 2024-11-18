<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Heureka;
use Lemonade\Feed\BaseItem;
use DateTime;

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
     * @var DateTime|int
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
     * @var string|int|null
     */
    protected $itemGroupId;
    
    /**
     * Kategorie zbozi
     * @var array|HeurekaCategoryText[]
     */
    protected $categoryTexts = [];
    
    /**
     * Darky
     * @var HeurekaGift[]
     */
    protected $gifts = [];

    /**
     * Constructor
     * @param string|int $itemId
     */
    public function __construct(string|int $itemId)
    {
        
        $this->itemId = $itemId;
    }

    /**
     * Vraci ID
     * @return string
     */
    public function getItemId(): string
    {
        
        return (string) $this->itemId;
    }

    /**
     * Nastavi nazev
     * @param string $productName
     * @return $this
     */
    public function setProductName(string $productName): self
    {
        
        $this->productName = $productName;
        
        return $this;
    }

    /**
     * Vraci nazev
     * @return string
     */
    public function getProductName(): string
    {
        
        return $this->productName;
    }

    /**
     * Nastavi popisek
     * @param string|null $description
     * @return $this
     */
    public function setDescription(string $description = null): self
    {
        
        $this->description = (string) $description;
        
        return $this;
    }

    /**
     * Vraci popisek
     * @return string
     */
    public function getDescription(): string
    {
        
        return $this->description;
    }   

    /**
     * Nastavi URL
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): self
    {
        
        $this->url = $url;
        
        return $this;
    }

    /**
     * Vraci URL
     * @return string
     */
    public function getUrl(): string
    {
        
        return $this->url;
    }

    /**
     * Nastavi menu
     * @param string $currencySymbol
     * @return $this
     */
    public function setCurrency(string $currencySymbol): self
    {
        
        $this->currency = $currencySymbol;
        
        return $this;
    }

    /**
     * Vraci menu
     * @return string
     */
    public function getCurrency(): string
    {
        
        return $this->currency;
    }

    /**
     * Nastavi cenu
     * @param string|int|float|null $priceVat
     * @return $this
     */
    public function setPriceVat(string|int|float $priceVat = null) {
        
        $this->priceVat = (float) $priceVat;
        
        return $this;
    }

    /**
     * Vraci cenu
     * @return float
     */
    public function getPriceVat(): float
    {
        
        return $this->priceVat;
    }

    /**
     * Nastavi DPH
     * @param string|int|null $dph
     * @return $this
     */
    public function addVatRate(string|int $dph = null) {
        
        $this->vatRate = (int) $dph;
        
        return $this;
    }

    /**
     * Vraci DPH
     * @return int
     */
    public function getVatRate(): int
    {
        
        return $this->vatRate;
    }

    /**
     * Nastavi obrazky
     * @param string|null $imageUrl
     * @return $this
     */
    public function addImage(string $imageUrl = null): self
    {
        
        $this->images[] = new HeurekaImage($imageUrl);
        
        return $this;
    }

    /**
     * Vraci obrazky
     * @return HeurekaImage[]|array
     */
    public function getImages(): array
    {
        
        return ($this->images ?? []);
    }

    /**
     * Nastavi EAN
     * @param string|null $ean
     * @return $this
     */
    public function addEan(string $ean = null): self
    {
        
        $this->ean = $ean;
        
        return $this;
    }

    /**
     * Vraci EAN
     * @return string|null
     */
    public function getEan(): ?string
    {
        
        return $this->ean;
    }

    /**
     * Nastavi ISBN
     * @param string|null $isbn
     * @return $this
     */
    public function addIsbn(string $isbn = null): self
    {
        
        $this->isbn = $isbn;
        
        return $this;
    }

    /**
     * Vraci ISBN
     * @return string|null
     */
    public function getIsbn(): ?string
    {
        
        return $this->isbn;
    }

    /**
     * Nastavi vyrobce
     * @param string|null $manufacturer
     * @return $this
     */
    public function addManufacturer(string $manufacturer = null): self
    {
        
        $this->manufacturer = $manufacturer;
        
        return $this;
    }    

    /**
     * Vrati vyrobce produktu
     * @return string|null
     */
    public function getManufacturer(): ?string
    {
        
        return $this->manufacturer;
    }

    /**
     * Nastaveni parametru produktu
     * @param string $name
     * @param string $val
     * @return $this
     */
    public function addParameter(string $name, string $val): self
    {
        
        $this->parameters[] = new HeurekaParameter($name, $val);
        
        return $this;
    }

    /**
     * Vraci parametry produktu
     * @return HeurekaParameter[]
     */
    public function getParameters(): array
    {
        
        return $this->parameters;
    }

    /**
     * Nastaveni nazvu kategorie podle feedu
     * @param string $text
     * @return $this
     */
    public function addCategoryText(string $text): self
    {
        
        $this->categoryTexts[] = new HeurekaCategoryText($text);
        
        return $this;
    }

    /**
     * Vraci kategorie
     * @return array|HeurekaCategoryText[]
     */
    public function getCategoryTexts(): array
    {
        
        return $this->categoryTexts;
    }

    /**
     * Dodaci doba ve dnech
     * @param int|DateTime $deliveryDate
     * @return $this
     */
    public function setDeliveryDate(int|DateTime $deliveryDate): self
    {
        
        if (is_int($deliveryDate) || ($deliveryDate instanceof DateTime)) {

            $this->deliveryDate = $deliveryDate;
        }
        
        return $this;
    }

    /**
     * @return int|string
     */
    public function getDeliveryDate(): int|string
    {
        
        return $this->deliveryDate instanceof DateTime ? $this->deliveryDate->format("Y-m-d") : (int) $this->deliveryDate;
    }

    /**
     * Zpusob a cena dopravy
     * @param HeurekaDelivery $delivery
     * @return $this
     */
    public function addDelivery(HeurekaDelivery $delivery): self
    {
        
        $this->deliveries[] = $delivery;
        
        return $this;
    }

    /**
     * Vraci zpusob a cenu dopravy
     * @return array|HeurekaDelivery
     */
    public function getDeliveries(): array|HeurekaDelivery
    {
        
        return ($this->deliveries ?? []);
    }

    /**
     * @param HeurekaGift $gift
     * @return $this
     */
    public function addGift(HeurekaGift $gift): self
    {
        
        $this->gifts[] = $gift;
        
        return $this;
    }

    /**
     * @return array|HeurekaGift[]
     */
    public function getGift(): array|HeurekaGift
    {
        
        return ($this->gifts ?? []);
    }

    /**
     * @param string|null $itemGroupId
     * @return $this
     */
    public function addItemGroupId(string|int $itemGroupId = null): self
    {
        
        $this->itemGroupId = ((string) $itemGroupId !== "" ? $itemGroupId : null);
        
        return $this;
    }

    /**
     * @return int|string|null
     */
    public function getItemGroupId(): int|string|null
    {
        
        return $this->itemGroupId;
    }

    /**
     * @return string
     */
    public static function getErrorString(): string
    {
        return "<?xml version=\"1.0\" encoding=\"UTF-8\"?><SHOP></SHOP>";
    }
  

}