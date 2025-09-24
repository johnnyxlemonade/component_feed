<?php declare(strict_types=1);

namespace Lemonade\Feed\Adapter\Heureka;

use Lemonade\Feed\Domain\Heureka\HeurekaItem;
use Lemonade\Feed\Infrastructure\Json\JsonExportable;

final class HeurekaItemJsonAdapter implements JsonExportable
{
    public function __construct(
        private readonly HeurekaItem $item
    ) {}

    public function toJson(): array
    {
        return [
            'id'          => $this->item->getId(),
            'productName' => $this->item->getName(),
            'description' => $this->item->getDescription(),
            'url'         => $this->item->getUrl(),
            'priceVat'    => $this->item->getPriceVat(),
            'manufacturer'=> $this->item->getManufacturer(),
            'category'    => $this->item->getCategory(),
        ];
    }
}
