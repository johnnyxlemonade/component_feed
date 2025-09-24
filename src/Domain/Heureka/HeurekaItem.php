<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Heureka;

use Lemonade\Feed\Domain\DomainItemInterface;
use Lemonade\Feed\Infrastructure\Json\JsonExportable;
use Symfony\Component\Validator\Constraints as Assert;

final class HeurekaItem implements DomainItemInterface, JsonExportable
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

    // --- Getter methods for missing properties ---
    public function getProductName(): string { return $this->productName; }
    public function getDescription(): string { return $this->description; }
    public function getUrl(): string { return $this->url; }
    public function getPriceVat(): float { return $this->priceVat; }
    public function getDeliveryDate(): ?int { return $this->deliveryDate; }
    public function getItemId(): ?string { return $this->itemId; }
    public function getEan(): ?string { return $this->ean; }
    public function getIsbn(): ?string { return $this->isbn; }
    public function getItemGroupId(): ?string { return $this->itemGroupId; }
    public function getManufacturer(): ?string { return $this->manufacturer; }
    public function getCategoryTexts(): array { return $this->categoryTexts; }
    public function getParameters(): array { return $this->parameters; }
    /** @return HeurekaImage[] */
    public function getImages(): array { return $this->images; }

    // --- JSON export ---
    public function toJson(): array
    {
        return [
            'productName'     => $this->productName,
            'description'     => $this->description,
            'url'             => $this->url,
            'priceVat'        => number_format($this->priceVat, 2, '.', ''), // Převod na string s 2 desetinnými místy
            'itemId'          => $this->itemId,
            'ean'             => $this->ean,
            'isbn'            => $this->isbn,
            'itemGroupId'     => $this->itemGroupId,
            'manufacturer'    => $this->manufacturer,
            'visibility'      => $this->isVisibility() ? 1 : 0, // Převod na 1/0 pro bool
            'images'          => array_map(fn($image) => $image->getUrl(), $this->images),
            'categoryTexts'   => array_map(fn($ct) => $ct->getText(), $this->categoryTexts),
            'parameters'      => array_map(fn($p) => [
                'name'  => $p->getName(),
                'value' => $p->getValue()
            ], $this->parameters),
            'deliveryDate'    => $this->deliveryDate !== null ? (string) $this->deliveryDate : null,
        ];
    }

    // --- Visibility check ---
    public function isVisibility(): bool
    {
        return !empty($this->productName) && $this->priceVat > 0; // Kontrola, zda je produkt viditelný (název a cena musí být platné)
    }
}
