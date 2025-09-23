<?php declare(strict_types=1);

namespace Lemonade\Feed\Demo;

use Lemonade\Feed\Domain\Google\GoogleItem;
use Lemonade\Feed\Domain\Google\GoogleImage;
use Lemonade\Feed\Domain\Google\GoogleShipping;
use Lemonade\Feed\Domain\Google\GoogleProductType;

final class GoogleFixture
{
    /**
     * @return iterable<GoogleItem>
     */
    public static function demo(int $count = 1000): iterable
    {
        for ($i = 1; $i <= $count; $i++) {
            $item = new GoogleItem(
                'SKU-' . $i,
                'Produkt #' . $i,
                'Popis produktu číslo ' . $i,
                'https://example.com/product/sku-' . $i,
                199.00 + $i,
                'CZK'
            );

            $item
                ->setCondition('new')
                ->setAvailability('in stock')
                ->setBrand('BrandX')
                ->addImage(new GoogleImage("https://example.com/image{$i}.jpg"))
                ->addShipping(new GoogleShipping('CZ', 'PPL', 99.0, 'CZK'))
                ->addProductType(new GoogleProductType('Kategorie / Subkategorie'));

            yield $item;
        }
    }
}
