<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Zbozi;

/**
 * Class ExtraMessage
 * @package Lemonade\Feed
 */
class ZboziExtraMessage{

    const EXTENDED_WARRANTY = 'extended_warranty',
          FREE_ACCESSORIES = 'free_accessories',
          FREE_CASE = 'free_case',
          FREE_DELIVERY = 'free_delivery',
          FREE_GIFT = 'free_gift',
          FREE_INSTALLATION = 'free_installation',
          FREE_STORE_PICKUP = 'free_store_pickup',
          VOUCHER = 'voucher';

    static $types = [
        self::EXTENDED_WARRANTY,
        self::FREE_ACCESSORIES,
        self::FREE_CASE,
        self::FREE_DELIVERY,
        self::FREE_GIFT,
        self::FREE_INSTALLATION,
        self::FREE_STORE_PICKUP,
        self::VOUCHER,
    ];

    /** @var string */
    protected $type;

    /**
     * ExtraMessage constructor.
     * @param $type
     */
    public function __construct($type) {
        if (!in_array($type, self::$types)) {
            throw new \InvalidArgumentException("Extra message with type $type doesn\t exist");
        }
        $this->type = (string) $type;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

}
