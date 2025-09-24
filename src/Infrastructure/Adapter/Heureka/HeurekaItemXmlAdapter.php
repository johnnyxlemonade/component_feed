<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Adapter\Heureka;

use Lemonade\Feed\Domain\DomainItemInterface;
use Lemonade\Feed\Domain\Heureka\HeurekaItem;
use Lemonade\Feed\Infrastructure\Adapter\HasDomainItem;
use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;

final class HeurekaItemXmlAdapter implements XmlExportable, HasDomainItem
{
    public function __construct(
        private readonly HeurekaItem $item
    ) {}

    public function getDomainItem(): DomainItemInterface
    {
        return $this->item;
    }

    public function toXml(XmlStreamWriter $xml): void
    {
        $xml->start('SHOPITEM');

        // Export základních údajů
        $xml->element('ITEM_ID', $this->item->getItemId());
        $xml->element('PRODUCTNAME', $this->item->getProductName());
        $xml->element('DESCRIPTION', $this->item->getDescription(), [], true);
        $xml->element('URL', $this->item->getUrl());
        $xml->element('PRICE_VAT', (string) $this->item->getPriceVat());

        // Nepovinné údaje
        $xml->element('MANUFACTURER', $this->item->getManufacturer());

        // Zpracování textů kategorií
        foreach ($this->item->getCategoryTexts() as $categoryText) {
            $xml->element('CATEGORYTEXT', $categoryText->getText()); // Předpokládáme, že ZboziCategoryText má metodu getText
        }

        // Zpracování dalších informací
        $xml->element('VISIBILITY', $this->item->isVisibility() ? '1' : '0');
        $xml->element('PRODUCT_LINE', $this->item->getItemGroupId());
        $xml->element('DELIVERY_DATE', $this->item->getDeliveryDate() !== null ? (string) $this->item->getDeliveryDate() : null); // int na string

        // Zpracování obrázků
        foreach ($this->item->getImages() as $index => $image) {
            $tag = $index === 0 ? 'IMGURL' : 'IMGURL_ALTERNATIVE';
            $xml->element($tag, $image->getUrl());
        }

        // Parametry
        foreach ($this->item->getParameters() as $param) {
            $xml->start('PARAM');
            $xml->element('PARAM_NAME', $param->getName());
            $xml->element('VAL', $param->getValue());
            $xml->end('PARAM');
        }

        // Uzavření SHOPITEM tagu
        $xml->end('SHOPITEM');
    }

}
