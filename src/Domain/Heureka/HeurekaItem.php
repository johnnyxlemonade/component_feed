<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Heureka;

use DateTimeInterface;
use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;
use Symfony\Component\Validator\Constraints as Assert;

final class HeurekaItem implements XmlExportable
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

    /** @var HeurekaDelivery[] */
    private array $deliveries = [];

    private ?string $itemId = null;

    /** @var HeurekaImage[] */
    private array $images = [];

    private ?string $ean = null;
    private ?string $isbn = null;
    private ?string $itemGroupId = null;
    private ?string $manufacturer = null;

    /** @var HeurekaCategoryText[] */
    private array $categoryTexts = [];

    /** @var HeurekaParameter[] */
    private array $parameters = [];

    public function __construct(string $productName, string $description, string $url, float $priceVat)
    {
        $this->productName = $productName;
        $this->description = $description;
        $this->url = $url;
        $this->priceVat = $priceVat;
    }

    // --- Fluent setters ---
    public function setDeliveryDate(?int $days): self { $this->deliveryDate = $days; return $this; }
    public function setItemId(?string $id): self { $this->itemId = $id; return $this; }
    public function setEan(?string $ean): self { $this->ean = $ean; return $this; }
    public function setIsbn(?string $isbn): self { $this->isbn = $isbn; return $this; }
    public function setItemGroupId(?string $id): self { $this->itemGroupId = $id; return $this; }
    public function setManufacturer(?string $manufacturer): self { $this->manufacturer = $manufacturer; return $this; }

    // --- Adders for collections ---
    public function addDelivery(HeurekaDelivery $delivery): self { $this->deliveries[] = $delivery; return $this; }
    public function addImage(HeurekaImage $image): self { $this->images[] = $image; return $this; }
    public function addCategoryText(HeurekaCategoryText $ct): self { $this->categoryTexts[] = $ct; return $this; }
    public function addParameter(HeurekaParameter $p): self { $this->parameters[] = $p; return $this; }

    // --- XML export ---
    public function toXml(XmlStreamWriter $xml): void
    {
        $xml->start('SHOPITEM');

        $xml->element('PRODUCTNAME', $this->productName);
        $xml->element('DESCRIPTION', $this->description, [], true); // CDATA
        $xml->element('URL', $this->url);
        $xml->element('PRICE_VAT', (string)$this->priceVat);
        $xml->element('DELIVERY_DATE', $this->deliveryDate !== null ? (string)$this->deliveryDate : null);

        foreach ($this->deliveries as $delivery) {
            $delivery->toXml($xml);
        }

        $xml->element('ITEM_ID', $this->itemId);

        foreach ($this->images as $index => $image) {
            $tag = $index === 0 ? 'IMGURL' : 'IMGURL_ALTERNATIVE';
            $xml->element($tag, $image->getUrl());
        }

        $xml->element('EAN', $this->ean);
        $xml->element('ISBN', $this->isbn);
        $xml->element('ITEMGROUP_ID', $this->itemGroupId);
        $xml->element('MANUFACTURER', $this->manufacturer);

        foreach ($this->categoryTexts as $ct) {
            $xml->element('CATEGORYTEXT', $ct->getText());
        }

        foreach ($this->parameters as $p) {
            $xml->start('PARAM');
            $xml->element('PARAM_NAME', $p->getName());
            $xml->element('VAL', $p->getValue());
            $xml->end('PARAM');
        }

        $xml->end('SHOPITEM');
    }
}
