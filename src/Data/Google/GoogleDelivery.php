<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Google;

/**
 * Reprezentace dodací podmínky pro XML feed Google Merchant Center.
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrak <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
final class GoogleDelivery
{
    public function __construct(
        protected readonly string $country,
        protected readonly string $service,
        protected readonly float|int|string $price,
        protected readonly string $currency = 'CZK'
    ) {
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getService(): string
    {
        return $this->service;
    }

    public function getPrice(): float
    {
        return (float) $this->price;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}
