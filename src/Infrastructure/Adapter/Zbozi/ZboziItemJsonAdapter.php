<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Adapter\Zbozi;

use Lemonade\Feed\Domain\DomainItemInterface;
use Lemonade\Feed\Domain\Zbozi\ZboziItem;
use Lemonade\Feed\Infrastructure\Adapter\HasDomainItem;
use Lemonade\Feed\Infrastructure\Json\JsonExportable;

final class ZboziItemJsonAdapter implements JsonExportable, HasDomainItem
{
    private ZboziItem $item;

    public function __construct(ZboziItem $item)
    {
        $this->item = $item;
    }

    public function getDomainItem(): DomainItemInterface
    {
        return $this->item;
    }

    /**
     * Converts ZboziItem to JSON array format
     */
    public function toJson(): array
    {
        return [
            'productName'     => $this->item->getProductName(),
            'description'     => $this->item->getDescription(),
            'url'             => $this->item->getUrl(),
            'priceVat'        => (string) $this->item->getPriceVat(), // Převod na string
            'itemId'          => $this->item->getItemId(),
            'ean'             => $this->item->getEan(),
            'isbn'            => $this->item->getIsbn(),
            'productNo'       => $this->item->getProductNo(),
            'itemGroupId'     => $this->item->getItemGroupId(),
            'manufacturer'    => $this->item->getManufacturer(),
            'brand'           => $this->item->getBrand(),
            'categoryId'      => $this->item->getCategoryId(),
            'product'         => $this->item->getProduct(),
            'visibility'      => $this->item->isVisibility() ? 1 : 0, // Převod na 1/0 pro bool
            'maxCpc'          => $this->item->getMaxCpc() !== null ? (string) $this->item->getMaxCpc() : null, // Převod na string
            'maxCpcSearch'    => $this->item->getMaxCpcSearch() !== null ? (string) $this->item->getMaxCpcSearch() : null, // Převod na string
            'productLine'     => $this->item->getProductLine(),
            'listPrice'       => $this->item->getListPrice() !== null ? (string) $this->item->getListPrice() : null, // Převod na string
            'releaseDate'     => $this->item->getReleaseDate() ? $this->item->getReleaseDate()->format('Y-m-d') : null, // Datum na formátovaný string
            'deliveryDate'    => $this->item->getDeliveryDate() !== null ? (string) $this->item->getDeliveryDate() : null, // int na string
        ];
    }
}
