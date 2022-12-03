<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Zbozi;

/**
 * Class Delivery
 * @package Lemonade\Feed
 */  
class ZboziDelivery{

    CONST CESKA_POSTA = 'CESKA_POSTA',
        CESKA_POSTA_NA_POSTU = 'CESKA_POSTA_NA_POSTU',
        CSAD_LOGISTIK_OSTRAVA = 'CSAD_LOGISTIK_OSTRAVA',
        SLOVENSKA_POSTA = 'SLOVENSKA_POSTA',
        DPD = 'DPD',
        DHL = 'DHL',
        DSV = 'DSV',
        EMS = 'EMS',
        FOFR = 'FOFR',
        GEBRUDER_WEISS = 'GEBRUDER_WEISS',
        GEIS = 'GEIS',
        GENERAL_PARCEL = 'GENERAL_PARCEL',
        GLS = 'GLS',
        HDS = 'HDS',
        HEUREKAPOINT = 'HEUREKAPOINT',
        INTIME = 'INTIME',
        PPL = 'PPL',
        RADIALKA = 'RADIALKA',
        SEEGMULLER = 'SEEGMULLER',
        TNT = 'TNT',
        TOPTRANS = 'TOPTRANS',
        UPS = 'UPS',
        ULOZENKA = 'ULOZENKA',
        VLASTNI_PREPRAVA = 'VLASTNI_PREPRAVA',
        ZASILKOVNA = 'ZASILKOVNA';


    static $ids = [
        self::CESKA_POSTA,
        self::CESKA_POSTA_NA_POSTU,
        self::CSAD_LOGISTIK_OSTRAVA,
        self::DPD,
        self::DHL,
        self::DSV,
        self::EMS,
        self::FOFR,
        self::GEBRUDER_WEISS,
        self::GEIS,
        self::GENERAL_PARCEL,
        self::GLS,
        self::HDS,
        self::HEUREKAPOINT,
        self::INTIME,
        self::PPL,
        self::RADIALKA,
        self::SEEGMULLER,
        self::TNT,
        self::TOPTRANS,
        self::UPS,
        self::ULOZENKA,
        self::VLASTNI_PREPRAVA,
        self::ZASILKOVNA,
        self::SLOVENSKA_POSTA,
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
        
        if (!in_array($id, self::$ids)) {
            throw new \InvalidArgumentException("Delivery with id $id doesn\t exist");
        }
        
        $this->id = (string) $id;
        $this->price = (float) $price;
        $this->priceCod = isset($priceCod) ? (float) $priceCod : null;
    }

    /**
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * @return float|null
     */
    public function getPriceCod() {
        return $this->priceCod;
    }

}
