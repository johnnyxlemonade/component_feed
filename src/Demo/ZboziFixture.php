<?php declare(strict_types=1);

namespace Lemonade\Feed\Demo;

use DateTimeImmutable;
use Lemonade\Feed\Domain\Zbozi\ZboziItem;
use Lemonade\Feed\Domain\Zbozi\ZboziDelivery;
use Lemonade\Feed\Domain\Zbozi\ZboziImage;
use Lemonade\Feed\Domain\Zbozi\ZboziParameter;
use Lemonade\Feed\Domain\Zbozi\ZboziCategoryText;
use Lemonade\Feed\Domain\Zbozi\ZboziExtraMessage;

final class ZboziFixture
{
    /**
     * @return iterable<ZboziItem>
     */
    public static function demo(int $count = 1000): iterable
    {
        for ($i = 1; $i <= $count; $i++) {
            $item = new ZboziItem(
                productName: "Test product $i",
                description: "This is test description for product $i",
                url: "https://example.com/product-$i",
                priceVat: (float) (100 + $i),
            );

            // Delivery
            $item->addDelivery(new ZboziDelivery('cpost', 99.0, 149.0));

            // Images
            $item->addImage(new ZboziImage("https://example.com/images/product-$i.jpg"));
            $item->addImage(new ZboziImage("https://example.com/images/product-{$i}-2.jpg"));

            // Identifikace
            $item->setItemId("ITEM-$i")
                ->setEan("1234567890$i")
                ->setManufacturer("Manufacturer $i")
                ->setBrand("Brand $i")
                ->setCategoryId((string) rand(1, 9999))
                ->setProductNo("PN-$i")
                ->setItemGroupId("GRP-" . (int)($i/10));

            // Kategorie texty
            $item->addCategoryText(new ZboziCategoryText("Electronics > Phones > Smartphone $i"));

            // Extra messages
            $item->addExtraMessage(new ZboziExtraMessage("gift"));
            $item->addExtraMessage(new ZboziExtraMessage("free_shipping"));

            // Parametry
            $item->addParameter(new ZboziParameter("Color", "Red"));
            $item->addParameter(new ZboziParameter("Weight", (string) (1.2 + $i/100), "kg"));

            // Volitelné
            $item->setDeliveryDate(1)
                ->setVisibility(true)
                ->setMaxCpc(15.0)
                ->setMaxCpcSearch(25.0)
                ->setProduct("Product Variant $i")
                ->setProductLine("Line $i")
                ->setListPrice((float) (120 + $i))
                ->setReleaseDate(new DateTimeImmutable());

            yield $item;
        }
    }
}
