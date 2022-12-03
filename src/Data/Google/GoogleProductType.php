<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Google;


/**
 * GoogleProductType
 * @package Lemonade\Feed
 */
class GoogleProductType {

    /** @var string */
    protected $text;

    /**
     * ExtraMessage constructor.
     * @param $text
     */
    public function __construct($text) {       
        $this->text = (string) $text;
    }

    /**
     * @return string
     */
    public function getText() {
        return $this->text;
    }

}
