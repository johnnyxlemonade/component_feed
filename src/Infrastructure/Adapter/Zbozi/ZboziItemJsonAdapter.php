<?php declare(strict_types=1);

namespace Lemonade\Feed\Adapter\Zbozi;

use Lemonade\Feed\Domain\Zbozi\ZboziItem;
use Lemonade\Feed\Infrastructure\Json\JsonExportable;

final class ZboziItemJsonAdapter implements JsonExportable
{
    public function __construct(
        private readonly ZboziItem $item
    ) {}

    public function toJson(): array
    {
        return [
            'productName' => $this->item->getName(),
            'description' => $this->item->getDescription(),
            'url'         => $this->item->getUrl(),
            'priceVat'    => $this->item->getPriceVat(),
        ];
    }
}
