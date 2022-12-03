<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Heureka;

/**
 * Class CategoryText
 * @package Lemonade\Feed
 */ 
class HeurekaCategoryText {

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
