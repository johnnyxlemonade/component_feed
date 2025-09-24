<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Google;

use Symfony\Component\Validator\Constraints as Assert;

final class GoogleShipping
{
    #[Assert\NotBlank]
    private string $country;

    #[Assert\NotBlank]
    #[Assert\Currency]
    private string $currency;

    #[Assert\PositiveOrZero]
    private float $price;

    public function __construct(string $country, string $currency, float $price)
    {
        $this->country  = $country;
        $this->currency = $currency;
        $this->price    = $price;
    }

    public function getCountry(): string { return $this->country; }
    public function getCurrency(): string { return $this->currency; }
    public function getPrice(): float { return $this->price; }

    /** Pomocná metoda pro JSON export */
    public function toArray(): array
    {
        return [
            'country'  => $this->country,
            'currency' => $this->currency,
            'price'    => $this->price,
        ];
    }
}
