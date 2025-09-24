<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Adapter\Heureka;

use Lemonade\Feed\Domain\Heureka\HeurekaItem;
use Lemonade\Feed\Infrastructure\Adapter\HasDomainItem;
use Lemonade\Feed\Infrastructure\Json\JsonExportable;
use Lemonade\Feed\Domain\DomainItemInterface;

final class HeurekaItemJsonAdapter implements JsonExportable, HasDomainItem
{
    public function __construct(
        private readonly HeurekaItem $item
    ) {}

    public function getDomainItem(): DomainItemInterface
    {
        return $this->item;
    }

    /**
     * Converts HeurekaItem to JSON array format
     */
    public function toJson(): array
    {
        return [
            'productName'     => $this->item->getProductName(),
            'description'     => $this->item->getDescription(),
            'url'             => $this->item->getUrl(),
            'priceVat'        => number_format($this->item->getPriceVat(), 2, '.', ''), // Převod na string s 2 desetinnými místy
            'itemId'          => $this->item->getItemId(),
            'ean'             => $this->item->getEan(),
            'isbn'            => $this->item->getIsbn(),
            'itemGroupId'     => $this->item->getItemGroupId(),
            'manufacturer'    => $this->item->getManufacturer(),
            'visibility'      => $this->item->isVisibility() ? 1 : 0, // Převod na 1/0 pro bool
            'deliveryDate'    => $this->item->getDeliveryDate() !== null ? (string) $this->item->getDeliveryDate() : null, // int na string
            'images'          => array_map(fn($image) => $image->getUrl(), $this->item->getImages()), // Obrazky
            'categoryTexts'   => array_map(fn($ct) => $ct->getText(), $this->item->getCategoryTexts()), // Kategorické texty
            'parameters'      => array_map(fn($p) => [
                'name'  => $p->getName(),
                'value' => $p->getValue()
            ], $this->item->getParameters()), // Parametry
        ];
    }
}
