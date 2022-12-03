<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Zbozi;

/**
 * Class CategoryText
 * @package Lemonade\Feed
 */ 
class ZboziCategoryText {

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
