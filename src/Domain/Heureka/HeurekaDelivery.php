<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Heureka;

use Symfony\Component\Validator\Constraints as Assert;

final class HeurekaDelivery
{
    #[Assert\NotBlank]
    private string $id;

    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    private float $price;

    #[Assert\PositiveOrZero]
    private ?float $priceCod;

    public function __construct(
        string $id,
        float $price,
        ?float $priceCod = null
    ) {
        $this->id = $id;
        $this->price = $price;
        $this->priceCod = $priceCod;
    }

    // Gettery pro jednotlivé vlastnosti
    public function getId(): string { return $this->id; }
    public function getPrice(): float { return $this->price; }
    public function getPriceCod(): ?float { return $this->priceCod; }

    // Převod na pole pro JSON export
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'priceCod' => $this->priceCod,
        ];
    }
}
