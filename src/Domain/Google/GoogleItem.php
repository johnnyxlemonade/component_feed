<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Google;

use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;
use Symfony\Component\Validator\Constraints as Assert;

final class GoogleItem implements XmlExportable
{
    #[Assert\NotBlank]
    private string $itemId;

    #[Assert\NotBlank]
    private string $productName;

    #[Assert\NotBlank]
    private string $description;

    #[Assert\NotBlank]
    #[Assert\Url]
    private string $url;

    /** @var GoogleShipping[] */
    private array $deliveries = [];

    /** @var GoogleImage[] */
    private array $images = [];

    private ?string $condition = null;
    private ?string $availability = null;

    #[Assert\NotBlank]
    private float $price;

    #[Assert\NotBlank]
    private string $currency;

    private ?float $salePrice = null;
    private bool $identifierExists = true;
    private ?string $gtin = null;
    private ?string $mpn = null;
    private ?string $brand = null;

    /** @var GoogleProductType[] */
    private array $productTypes = [];

    private ?string $availabilityDate = null;
    private ?string $googleProductCategory = null;
    private ?string $itemGroupId = null;

    public function __construct(string $itemId, string $productName, string $description, string $url, float $price, string $currency)
    {
        $this->itemId = $itemId;
        $this->productName = $productName;
        $this->description = $description;
        $this->url = $url;
        $this->price = $price;
        $this->currency = $currency;
    }

    public function addShipping(GoogleShipping $shipping): self
    {
        $this->deliveries[] = $shipping;
        return $this;
    }

    public function addImage(GoogleImage $image): self
    {
        $this->images[] = $image;
        return $this;
    }

    public function addProductType(GoogleProductType $type): self
    {
        $this->productTypes[] = $type;
        return $this;
    }

    // setters (condition, availability, salePrice, identifierExists, gtin, mpn, brand, availabilityDate, googleProductCategory, itemGroupId)
    public function setCondition(?string $condition): self { $this->condition = $condition; return $this; }
    public function setAvailability(?string $availability): self { $this->availability = $availability; return $this; }
    public function setSalePrice(?float $salePrice): self { $this->salePrice = $salePrice; return $this; }
    public function setIdentifierExists(bool $exists): self { $this->identifierExists = $exists; return $this; }
    public function setGtin(?string $gtin): self { $this->gtin = $gtin; return $this; }
    public function setMpn(?string $mpn): self { $this->mpn = $mpn; return $this; }
    public function setBrand(?string $brand): self { $this->brand = $brand; return $this; }
    public function setAvailabilityDate(?string $date): self { $this->availabilityDate = $date; return $this; }
    public function setGoogleProductCategory(?string $cat): self { $this->googleProductCategory = $cat; return $this; }
    public function setItemGroupId(?string $id): self { $this->itemGroupId = $id; return $this; }

    public function toXml(XmlStreamWriter $xml): void
    {
        $xml->start('item');

        $xml->element('g:id', $this->itemId);
        $xml->element('title', $this->productName, [], true);
        $xml->element('description', $this->description, [], true);
        $xml->element('link', $this->url, [], true);

        foreach ($this->deliveries as $delivery) {
            $delivery->toXml($xml);
        }

        foreach ($this->images as $index => $image) {
            $tag = $index === 0 ? 'g:image_link' : 'g:additional_image_link';
            $xml->element($tag, $image->getUrl(), [], true);
        }

        $xml->element('g:condition', $this->condition);
        $xml->element('g:availability', $this->availability);
        $xml->element('g:price', sprintf('%.2f %s', $this->price, $this->currency));
        $xml->element('g:sale_price', $this->salePrice !== null ? sprintf('%.2f %s', $this->salePrice, $this->currency) : null);
        $xml->element('g:identifier_exists', $this->identifierExists ? 'TRUE' : 'FALSE');
        $xml->element('g:gtin', $this->gtin);
        $xml->element('g:mpn', $this->mpn);
        $xml->element('g:brand', $this->brand);

        foreach ($this->productTypes as $type) {
            $xml->element('g:product_type', $type->getText());
        }

        $xml->element('g:availability_date', $this->availabilityDate);
        $xml->element('g:google_product_category', $this->googleProductCategory);
        $xml->element('g:item_group_id', $this->itemGroupId);

        $xml->end('item');
    }
}
