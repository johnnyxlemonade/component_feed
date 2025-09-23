<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Zbozi;

use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;

final class ZboziDelivery implements XmlExportable
{
    public function __construct(
        private readonly string $id,
        private readonly float $price,
        private readonly ?float $priceCod = null,
    ) {}

    public function toXml(XmlStreamWriter $xml): void
    {
        $xml->start('DELIVERY');
        $xml->element('DELIVERY_ID', $this->id);
        $xml->element('DELIVERY_PRICE', (string) $this->price);
        $xml->element('DELIVERY_PRICE_COD', $this->priceCod !== null ? (string) $this->priceCod : null);
        $xml->end('DELIVERY');
    }
}
