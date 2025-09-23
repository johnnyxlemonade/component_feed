<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Zbozi;

use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;
use Symfony\Component\Validator\Constraints as Assert;

final class ZboziItem implements XmlExportable
{
    #[Assert\NotBlank]
    private string $productName;

    #[Assert\NotBlank]
    private string $description;

    #[Assert\NotBlank]
    #[Assert\Url]
    private string $url;

    #[Assert\NotBlank]
    private float $priceVat;

    private ?int $deliveryDate = null;

    /** @var ZboziDelivery[] */
    private array $deliveries = [];

    /** @var ZboziImage[] */
    private array $images = [];

    private ?string $itemId = null;
    private ?string $ean = null;
    private ?string $isbn = null;
    private ?string $productNo = null;
    private ?string $itemGroupId = null;
    private ?string $manufacturer = null;
    private ?string $brand = null;
    private ?string $categoryId = null;

    /** @var ZboziCategoryText[] */
    private array $categoryTexts = [];

    private ?string $product = null;
    /** @var ZboziExtraMessage[] */
    private array $extraMessages = [];

    private bool $visibility = true;
    private ?float $maxCpc = null;
    private ?float $maxCpcSearch = null;

    /** @var ZboziParameter[] */
    private array $parameters = [];

    private ?string $productLine = null;
    private ?float $listPrice = null;
    private ?\DateTimeInterface $releaseDate = null;

    public function __construct(
        string $productName,
        string $description,
        string $url,
        float $priceVat
    ) {
        $this->productName = $productName;
        $this->description = $description;
        $this->url = $url;
        $this->priceVat = $priceVat;
    }

    // --- Fluent addery ---
    public function addDelivery(ZboziDelivery $delivery): self
    {
        $this->deliveries[] = $delivery;
        return $this;
    }

    public function addImage(ZboziImage $image): self
    {
        $this->images[] = $image;
        return $this;
    }

    public function addCategoryText(ZboziCategoryText $ct): self
    {
        $this->categoryTexts[] = $ct;
        return $this;
    }

    public function addExtraMessage(ZboziExtraMessage $em): self
    {
        $this->extraMessages[] = $em;
        return $this;
    }

    public function addParameter(ZboziParameter $param): self
    {
        $this->parameters[] = $param;
        return $this;
    }

    // --- Jednoduché settery ---
    public function setItemId(?string $itemId): self { $this->itemId = $itemId; return $this; }
    public function setEan(?string $ean): self { $this->ean = $ean; return $this; }
    public function setIsbn(?string $isbn): self { $this->isbn = $isbn; return $this; }
    public function setProductNo(?string $productNo): self { $this->productNo = $productNo; return $this; }
    public function setItemGroupId(?string $id): self { $this->itemGroupId = $id; return $this; }
    public function setManufacturer(?string $m): self { $this->manufacturer = $m; return $this; }
    public function setBrand(?string $b): self { $this->brand = $b; return $this; }
    public function setCategoryId(?string $id): self { $this->categoryId = $id; return $this; }
    public function setProduct(?string $p): self { $this->product = $p; return $this; }
    public function setVisibility(bool $v): self { $this->visibility = $v; return $this; }
    public function setMaxCpc(?float $c): self { $this->maxCpc = $c; return $this; }
    public function setMaxCpcSearch(?float $c): self { $this->maxCpcSearch = $c; return $this; }
    public function setProductLine(?string $pl): self { $this->productLine = $pl; return $this; }
    public function setListPrice(?float $lp): self { $this->listPrice = $lp; return $this; }
    public function setReleaseDate(?\DateTimeInterface $rd): self { $this->releaseDate = $rd; return $this; }
    public function setDeliveryDate(?int $dd): self { $this->deliveryDate = $dd; return $this; }

    // --- XML export ---
    public function toXml(XmlStreamWriter $xml): void
    {
        $xml->start('SHOPITEM');
        $xml->element('PRODUCTNAME', $this->productName);
        $xml->element('DESCRIPTION', $this->description, [], true);
        $xml->element('URL', $this->url);
        $xml->element('PRICE_VAT', (string)$this->priceVat);
        $xml->element('DELIVERY_DATE', $this->deliveryDate !== null ? (string)$this->deliveryDate : null);

        foreach ($this->deliveries as $d) { $d->toXml($xml); }
        $xml->element('ITEM_ID', $this->itemId);

        foreach ($this->images as $img) {
            $xml->element('IMGURL', $img->getUrl());
        }

        $xml->element('EAN', $this->ean);
        $xml->element('ISBN', $this->isbn);
        $xml->element('PRODUCTNO', $this->productNo);
        $xml->element('ITEMGROUP_ID', $this->itemGroupId);
        $xml->element('MANUFACTURER', $this->manufacturer);
        $xml->element('BRAND', $this->brand);
        $xml->element('CATEGORY_ID', $this->categoryId);

        foreach ($this->categoryTexts as $ct) {
            $xml->element('CATEGORYTEXT', $ct->getText());
        }

        $xml->element('PRODUCT', $this->product);

        foreach ($this->extraMessages as $em) {
            $xml->element('EXTRA_MESSAGE', $em->getType());
        }

        $xml->element('VISIBILITY', $this->visibility ? '1' : '0');
        $xml->element('MAX_CPC', $this->maxCpc !== null ? (string)$this->maxCpc : null);
        $xml->element('MAX_CPC_SEARCH', $this->maxCpcSearch !== null ? (string)$this->maxCpcSearch : null);

        foreach ($this->parameters as $p) { $p->toXml($xml); }

        $xml->element('PRODUCT_LINE', $this->productLine);
        $xml->element('LIST_PRICE', $this->listPrice !== null ? (string)$this->listPrice : null);
        $xml->element('RELEASE_DATE', $this->releaseDate?->format('c'));

        $xml->end('SHOPITEM');
    }
}
