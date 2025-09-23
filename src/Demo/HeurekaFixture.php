<?php declare(strict_types=1);

namespace Lemonade\Feed\Demo;

use Lemonade\Feed\Domain\Heureka\HeurekaItem;
use Lemonade\Feed\Domain\Heureka\HeurekaDelivery;
use Lemonade\Feed\Domain\Heureka\HeurekaImage;
use Lemonade\Feed\Domain\Heureka\HeurekaCategoryText;
use Lemonade\Feed\Domain\Heureka\HeurekaParameter;

final class HeurekaFixture
{
    /**
     * @return iterable<HeurekaItem>
     */
    public static function demo(int $count = 1000): iterable
    {
        for ($i = 1; $i <= $count; $i++) {
            $item = new HeurekaItem(
                "Product $i",
                "Description of product $i",
                "https://example.com/product-$i",
                100 + $i
            );

            $item->setItemId((string)$i)
                ->setEan("123456789$i")
                ->setManufacturer("Manufacturer $i")
                ->setDeliveryDate(rand(0, 5));

            $item->addDelivery(new HeurekaDelivery("personal_pickup", 0.0, null));
            $item->addDelivery(new HeurekaDelivery("czech_post", 89.0, 120.0));

            $item->addImage(new HeurekaImage("https://example.com/images/$i.jpg"));
            $item->addImage(new HeurekaImage("https://example.com/images/$i-alt.jpg"));

            $item->addCategoryText(new HeurekaCategoryText("Category > Subcategory $i"));
            $item->addParameter(new HeurekaParameter("Color", "Red"));
            $item->addParameter(new HeurekaParameter("Size", "XL"));

            yield $item;
        }
    }
}
