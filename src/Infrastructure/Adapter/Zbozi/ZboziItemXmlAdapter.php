<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Adapter\Zbozi;

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

        // Základní údaje produktu
        $xml->element('PRODUCTNAME', $this->item->getProductName());
        $xml->element('DESCRIPTION', $this->item->getDescription(), [], true);
        $xml->element('URL', $this->item->getUrl());
        $xml->element('PRICE_VAT', (string) $this->item->getPriceVat());

        // Nepovinné a volitelné údaje
        $xml->element('ITEM_ID', $this->item->getItemId());
        $xml->element('EAN', $this->item->getEan());
        $xml->element('ISBN', $this->item->getIsbn());
        $xml->element('PRODUCTNO', $this->item->getProductNo());
        $xml->element('ITEMGROUP_ID', $this->item->getItemGroupId());
        $xml->element('MANUFACTURER', $this->item->getManufacturer());
        $xml->element('BRAND', $this->item->getBrand());
        $xml->element('CATEGORY_ID', $this->item->getCategoryId());

        // Zpracování ZboziDelivery
        foreach ($this->item->getDeliveries() as $delivery) {
            $xml->start('DELIVERY');
            $xml->element('DELIVERY_ID', $delivery->getId());
            $xml->element('DELIVERY_PRICE', (string) $delivery->getPrice()); // Převod na string
            $xml->element('DELIVERY_PRICE_COD', $delivery->getPriceCod() !== null ? (string) $delivery->getPriceCod() : null);
            $xml->end('DELIVERY');
        }

        // Zpracování obrázků
        foreach ($this->item->getImages() as $index => $image) {
            $tag = $index === 0 ? 'IMGURL' : 'IMGURL_ALTERNATIVE';
            $xml->element($tag, $image->getUrl());
        }

        // Zpracování textů kategorií
        foreach ($this->item->getCategoryTexts() as $categoryText) {
            $xml->element('CATEGORYTEXT', $categoryText->getText());
        }

        // Zpracování dalších informací
        $xml->element('PRODUCT', $this->item->getProduct());

        // Parametry
        foreach ($this->item->getParameters() as $param) {
            $xml->start('PARAM');
            $xml->element('PARAM_NAME', $param->getName());
            $xml->element('VAL', $param->getValue());
            $xml->element('UNIT', $param->getUnit());
            $xml->end('PARAM');
        }

        // Zpracování extra zpráv
        foreach ($this->item->getExtraMessages() as $extraMessage) {
            $xml->element('EXTRA_MESSAGE', $extraMessage->getType());
        }

        // Převod logických a číselných hodnot na string
        $xml->element('VISIBILITY', $this->item->isVisibility() ? '1' : '0'); // Boolean na string
        $xml->element('MAX_CPC', $this->item->getMaxCpc() !== null ? (string) $this->item->getMaxCpc() : ''); // float na string
        $xml->element('MAX_CPC_SEARCH', $this->item->getMaxCpcSearch() !== null ? (string) $this->item->getMaxCpcSearch() : ''); // float na string
        $xml->element('PRODUCT_LINE', $this->item->getProductLine());
        $xml->element('LIST_PRICE', $this->item->getListPrice() !== null ? (string) $this->item->getListPrice() : ''); // float na string
        $xml->element('RELEASE_DATE', $this->item->getReleaseDate() ? $this->item->getReleaseDate()->format('Y-m-d') : null); // Datum na formátovaný string
        $xml->element('DELIVERY_DATE', $this->item->getDeliveryDate() !== null ? (string)$this->item->getDeliveryDate() : null); // int na string

        $xml->end('SHOPITEM');
    }
}
