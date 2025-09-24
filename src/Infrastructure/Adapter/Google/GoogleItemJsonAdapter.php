<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Adapter\Google;

use Lemonade\Feed\Domain\DomainItemInterface;
use Lemonade\Feed\Domain\Google\GoogleItem;
use Lemonade\Feed\Infrastructure\Adapter\HasDomainItem;
use Lemonade\Feed\Infrastructure\Json\JsonExportable;

final class GoogleItemJsonAdapter implements JsonExportable, HasDomainItem
{
    public function __construct(
        private readonly GoogleItem $item
    ) {}

    public function getDomainItem(): DomainItemInterface
    {
        return $this->item;
    }

    public function toJson(): array
    {
        return [
            'id'          => $this->item->getId(),
            'title'       => $this->item->getTitle(),
            'description' => $this->item->getDescription(),
            'link'        => $this->item->getLink(),
            'price'       => sprintf('%.2f %s', $this->item->getPrice(), $this->item->getCurrency()),
            'sale_price'  => $this->item->getSalePrice(),
            'condition'   => $this->item->getCondition(),
            'availability'=> $this->item->getAvailability(),
            'brand'       => $this->item->getBrand(),
            'gtin'        => $this->item->getGtin(),
            'mpn'         => $this->item->getMpn(),
            'identifier_exists' => $this->item->getIdentifierExists(),
            'images'      => array_map(fn($i) => $i->getUrl(), $this->item->getImages()),
            'shipping'    => array_map(fn($s) => [
                'country'  => $s->getCountry(),
                'price'    => sprintf('%.2f %s', $s->getPrice(), $s->getCurrency())
            ], $this->item->getShippings()),
            'product_types' => array_map(fn($p) => $p->getText(), $this->item->getProductTypes()),
            'availability_date' => $this->item->getAvailabilityDate(),
            'google_product_category' => $this->item->getGoogleProductCategory(),
            'item_group_id' => $this->item->getItemGroupId(),
        ];
    }
}
