<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Heureka;

/**
 * Class Delivery
 * @package Lemonade\Feed
 */  
class HeurekaDelivery {

    const 
    CESKA_POSTA = "CESKA_POSTA",
    CESKA_POSTA_NAPOSTU_DEPOTAPI = "CESKA_POSTA_NAPOSTU_DEPOTAPI",
    CESKA_POSTA_DOPORUCENA_ZASILKA = "CESKA_POSTA_DOPORUCENA_ZASILKA",
    CSAD_LOGISTIK_OSTRAVA = "CSAD_LOGISTIK_OSTRAVA",
    DPD = "DPD",
    DHL = "DHL",
    DSV = "DSV",
    FOFR = "FOFR",
    GEBRUDER_WEISS = "GEBRUDER_WEISS",
    GEIS = "GEIS",
    GLS = "GLS",
    HDS = "HDS",
    PPL = "PPL",
    SEEGMULLER = "SEEGMULLER",
    TNT = "TNT",
    TOPTRANS = "TOPTRANS",
    UPS = "UPS",
    FEDEX = "FEDEX",
    RABEN_LOGISTICS = "RABEN_LOGISTICS",
    ZASILKOVNA = "ZASILKOVNA",
    DPD_PICKUP = "DPD_PICKUP",
    BALIKOVNA_DEPOTAPI = "BALIKOVNA_DEPOTAPI",
    ULOZENKA = "ULOZENKA",
    WEDO = "WEDO",
    ZASILKOVNA_NA_ADRESU = "ZASILKOVNA_NA_ADRESU",
    PPL_PARCELSHOP = "PPL_PARCELSHOP",
    GLS_PARCELSHOP = "GLS_PARCELSHOP",
    RHENUS_LOGISTICS = "RHENUS_LOGISTICS",
    VLASTNI_PREPRAVA = "VLASTNI_PREPRAVA";
    
    static $deliveryArray = [
        self::CESKA_POSTA,
        self::CESKA_POSTA_NAPOSTU_DEPOTAPI,
        self::CESKA_POSTA_DOPORUCENA_ZASILKA,
        self::CSAD_LOGISTIK_OSTRAVA,
        self::DPD,
        self::DHL,
        self::DSV,
        self::FOFR,
        self::GEBRUDER_WEISS,
        self::GEIS,
        self::GLS,
        self::HDS,
        self::PPL,
        self::SEEGMULLER,
        self::TNT,
        self::TOPTRANS,
        self::UPS,
        self::FEDEX,
        self::RABEN_LOGISTICS,
        self::ZASILKOVNA,
        self::DPD_PICKUP,
        self::BALIKOVNA_DEPOTAPI,
        self::ULOZENKA,
        self::WEDO,
        self::ZASILKOVNA_NA_ADRESU,
        self::PPL_PARCELSHOP,
        self::GLS_PARCELSHOP,
        self::RHENUS_LOGISTICS,
        self::VLASTNI_PREPRAVA
    ];

    /** @var string */
    private $id;
    
    /** @var float */
    private $price;
    
    /** @var float|null */
    private $priceCod;

    /**
     * Delivery constructor.
     * @param $id
     * @param $price
     * @param null $priceCod
     */
    public function __construct($id, $price, $priceCod = null) {
        
        if (in_array($id, self::$deliveryArray)) {
            
            $this->id = (string) $id;
            $this->price = (float) $price;
            $this->priceCod = (float) ($priceCod ?? $price);
        }
        
    }

    /**
     * Vraci Id
     * @return string
     */
    public function getId() {
        
        return $this->id;
    }

    /**
     * Vraci cenu
     * @return float
     */
    public function getPrice() {
        
        return $this->price;
    }

    /**
     * Celkova cena
     * @return float|null
     */
    public function getPriceCod() {
        
        return $this->priceCod;
    }

}
