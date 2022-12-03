<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Heureka;

/**
 * Class HeurekaGift
 * @package Lemonade\Feed
 * @see https://sluzby.heureka.cz/napoveda/xml-feed/
 */
class HeurekaGift {

    protected $id;
    protected $name;

    /**
     * Parameter constructor.
     * @param $name
     * @param $value
     */
    public function __construct(string $id, string $name) {
        
        $this->name = (string) $name;
        $this->value = (string) $name;
    }

    /**
     * Vraci id darku
     * @return mixed
     */
    public function getId() {
        
        return $this->id;
    }

    /**
     * Vraci nazev darku
     * @return mixed
     */
    public function getName() {
        
        return $this->name;
    }


}
