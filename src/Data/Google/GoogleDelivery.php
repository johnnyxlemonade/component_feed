<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Google;

/**
 * GoogleDelivery
 * @package Lemonade\Feed
 */ 
class GoogleDelivery {

    /** @var string */
    private $country;
    
    /** @var string */
    private $service;
    
    /** @var float */
    private $price;
    
    /** @var string */
    private $currency;

    /**
     * Delivery constructor.
     * @param $countryCode
     * @param $countryRegion
     * @param null $priceCod
     */
    public function __construct($countryCode, $serviceName, $price, $currency = "CZK") {  
        
        $this->country = (string) $countryCode;
        $this->service = (string) $serviceName;                
        $this->price = (float) $price;
        $this->currency = (string) $currency;
    }

    /**
     * @return string
     */
    public function getCountry() {
        return $this->country;
    }
    
    /**
     * @return string
     */
    public function getService() {
        return $this->service;
    }

    /**
     * @return float
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getCurrency() {
        return $this->currency;
    }

}
