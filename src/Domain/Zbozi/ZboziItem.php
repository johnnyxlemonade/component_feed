<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Zbozi;

use Lemonade\Feed\Domain\DomainItemInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class ZboziItem implements DomainItemInterface
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

    public function addCategoryText(ZboziCategoryText $categoryText): self
    {
        $this->categoryTexts[] = $categoryText;
        return $this;
    }

    public function addExtraMessage(ZboziExtraMessage $extraMessage): self
    {
        $this->extraMessages[] = $extraMessage;
        return $this;
    }

    public function addParameter(ZboziParameter $parameter): self
    {
        $this->parameters[] = $parameter;
        return $this;
    }

    // --- Getter methods ---
    public function getProductName(): string { return $this->productName; }
    public function getDescription(): string { return $this->description; }
    public function getUrl(): string { return $this->url; }
    public function getPriceVat(): float { return $this->priceVat; }
    public function getDeliveryDate(): ?int { return $this->deliveryDate; }
    public function getItemId(): ?string { return $this->itemId; }
    public function getEan(): ?string { return $this->ean; }
    public function getIsbn(): ?string { return $this->isbn; }
    public function getProductNo(): ?string { return $this->productNo; }
    public function getItemGroupId(): ?string { return $this->itemGroupId; }
    public function getManufacturer(): ?string { return $this->manufacturer; }
    public function getBrand(): ?string { return $this->brand; }
    public function getCategoryId(): ?string { return $this->categoryId; }
    public function getProduct(): ?string { return $this->product; }
    public function isVisibility(): bool { return $this->visibility; }
    public function getMaxCpc(): ?float { return $this->maxCpc; }
    public function getMaxCpcSearch(): ?float { return $this->maxCpcSearch; }
    public function getProductLine(): ?string { return $this->productLine; }
    public function getListPrice(): ?float { return $this->listPrice; }
    public function getReleaseDate(): ?\DateTimeInterface { return $this->releaseDate; }

    /** @return ZboziDelivery[] */
    public function getDeliveries(): array { return $this->deliveries; }

    /** @return ZboziImage[] */
    public function getImages(): array { return $this->images; }

    /** @return ZboziCategoryText[] */
    public function getCategoryTexts(): array { return $this->categoryTexts; }

    /** @return ZboziExtraMessage[] */
    public function getExtraMessages(): array { return $this->extraMessages; }

    /** @return ZboziParameter[] */
    public function getParameters(): array { return $this->parameters; }

    // --- Setter methods ---
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
}
