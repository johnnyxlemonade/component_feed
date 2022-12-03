<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Heureka;

/**
 * Class Parameter
 * @package Lemonade\Feed
 * @see https://sluzby.heureka.cz/napoveda/xml-feed/
 */
class HeurekaParameter {

    protected $name;
    protected $value;

    /**
     * Parameter constructor.
     * @param $name
     * @param $value
     */
    public function __construct(string $name, string $value) {
        
        $this->name = (string) $name;
        $this->value = (string) $value;
    }

    /**
     * Vraci nazev parametru
     * @return mixed
     */
    public function getName() {
        
        return $this->name;
    }

    /**
     * Vraci hodnotu parametru
     * @return mixed
     */
    public function getValue() {
        
        return $this->value;
    }


}
