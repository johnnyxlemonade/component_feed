<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Zbozi;

/**
 * Class Parameter
 * @package Lemonade\Feed
 * @see https://napoveda.zbozi.cz/xml-feed/specifikace/#PARAM
 */
class ZboziParameter{

    protected $name;
    protected $value;
    protected $unit;

    /**
     * Parameter constructor.
     * @param $name
     * @param $value
     * @param $unit
     */
    public function __construct($name, $value, $unit = null) {
        $this->name = (string)$name;
        $this->value = (string)$value;
        $this->unit = isset($unit) ? (string) $unit : null;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @return null
     */
    public function getUnit() {
        return $this->unit;
    }

}
