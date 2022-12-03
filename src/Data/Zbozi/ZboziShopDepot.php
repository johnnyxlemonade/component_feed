<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Zbozi;

/**
 * Class ShopDepot
 * @package Lemonade\Feed
 */
class ZboziShopDepot {

    private $id;

    public function __construct($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

}
