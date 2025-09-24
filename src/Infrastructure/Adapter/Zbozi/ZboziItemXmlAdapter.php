<?php declare(strict_types=1);

namespace Lemonade\Feed\Adapter\Zbozi;

use Lemonade\Feed\Domain\Zbozi\ZboziItem;
use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;

final class ZboziItemXmlAdapter implements XmlExportable
{
    public function __construct(
        private readonly ZboziItem $item
    ) {}

    public function toXml(XmlStreamWriter $xml): void
    {
        $xml->start('SHOPITEM');
        $xml->element('PRODUCTNAME', $this->item->getName());
        $xml->element('DESCRIPTION', $this->item->getDescription());
        $xml->element('URL', $this->item->getUrl());
        $xml->element('PRICE_VAT', $this->item->getPriceVat());
        // … další elementy
        $xml->end('SHOPITEM');
    }
}
