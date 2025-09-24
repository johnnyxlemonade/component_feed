<?php declare(strict_types=1);

namespace Lemonade\Feed\Adapter\Heureka;

use Lemonade\Feed\Domain\Heureka\HeurekaItem;
use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;

final class HeurekaItemXmlAdapter implements XmlExportable
{
    public function __construct(
        private readonly HeurekaItem $item
    ) {}

    public function toXml(XmlStreamWriter $xml): void
    {
        $xml->start('SHOPITEM');
        $xml->element('ITEM_ID', $this->item->getId());
        $xml->element('PRODUCTNAME', $this->item->getName());
        $xml->element('DESCRIPTION', $this->item->getDescription());
        $xml->element('URL', $this->item->getUrl());
        $xml->element('PRICE_VAT', $this->item->getPriceVat());
        $xml->element('MANUFACTURER', $this->item->getManufacturer());
        $xml->element('CATEGORYTEXT', $this->item->getCategory());
        // … další elementy podle Heureka specifikace
        $xml->end('SHOPITEM');
    }
}
