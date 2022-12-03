<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Google;

/**
 * Class Image
 * @package Lemonade\Feed
 */ 
class GoogleImage {

    private $url;

    /**
     * Image constructor.
     * @param $url
     */
    public function __construct($url) {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getUrl() {
        return $this->url;
    }

}
