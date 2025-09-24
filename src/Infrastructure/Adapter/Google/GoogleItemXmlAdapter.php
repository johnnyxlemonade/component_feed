<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Adapter\Google;

use Lemonade\Feed\Domain\DomainItemInterface;
use Lemonade\Feed\Domain\Google\GoogleItem;
use Lemonade\Feed\Infrastructure\Adapter\HasDomainItem;
use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;

final class GoogleItemXmlAdapter implements XmlExportable, HasDomainItem
{
    public function __construct(
        private readonly GoogleItem $item
    ) {}

    public function getDomainItem(): DomainItemInterface
    {
        return $this->item;
    }

    public function toXml(XmlStreamWriter $xml): void
    {
        $xml->start('item');

        $xml->element('g:id', $this->item->getId());
        $xml->element('title', $this->item->getTitle(), [], true);
        $xml->element('description', $this->item->getDescription(), [], true);
        $xml->element('link', $this->item->getLink());

        foreach ($this->item->getShippings() as $shipping) {
            $xml->start('g:shipping');
            $xml->element('g:country', $shipping->getCountry());
            $xml->element(
                'g:price',
                sprintf('%.2f %s', $shipping->getPrice(), $shipping->getCurrency())
            );
            $xml->end('g:shipping');
        }

        foreach ($this->item->getImages() as $index => $image) {
            $tag = $index === 0 ? 'g:image_link' : 'g:additional_image_link';
            $xml->element($tag, $image->getUrl());
        }

        $xml->element('g:condition', $this->item->getCondition());
        $xml->element('g:availability', $this->item->getAvailability());
        $xml->element(
            'g:price',
            sprintf('%.2f %s', $this->item->getPrice(), $this->item->getCurrency())
        );

        if ($this->item->getSalePrice() !== null) {
            $xml->element(
                'g:sale_price',
                sprintf('%.2f %s', $this->item->getSalePrice(), $this->item->getCurrency())
            );
        }

        // 🔑 tady je ta oprava – správný getter
        $xml->element('g:identifier_exists', $this->item->getIdentifierExists() ? 'TRUE' : 'FALSE');

        $xml->element('g:gtin', $this->item->getGtin());
        $xml->element('g:mpn', $this->item->getMpn());
        $xml->element('g:brand', $this->item->getBrand());

        foreach ($this->item->getProductTypes() as $type) {
            $xml->element('g:product_type', $type->getText());
        }

        $xml->element('g:availability_date', $this->item->getAvailabilityDate());
        $xml->element('g:google_product_category', $this->item->getGoogleProductCategory());
        $xml->element('g:item_group_id', $this->item->getItemGroupId());

        $xml->end('item');
    }
}
