<?php



require __DIR__ . "/vendor/autoload.php";

// import NS
use Lemonade\Component\Feed\BaseStorage;
use Lemonade\Component\Feed\Data\Heureka\HeurekaGenerator;
use Lemonade\Component\Feed\Data\Heureka\HeurekaItem;
use Lemonade\Component\Feed\Data\Heureka\HeurekaDelivery;
use Lemonade\Component\Feed\Data\Heureka\HeurekaGift;


// generator
$generator = new HeurekaGenerator(new BaseStorage(), "feed.test.localhost", "Feed web");

// data
$data = [
    (object) [
        "productId" => 1,
        "productName" => "Paralen 12x500mg",
        "productDescription" => "Ke snížení horečky a bolesti při chřipce, nachlazení a jiných infekčních onemocněních. Dále při bolestech hlavy, zubů, bolestivé menstruaci, bolesti v krku a bolesti pohybového ústrojí provázející chřipku a nachlazení.",
        "productUrl" => "https://core1.agency",
        "productPrice" => 109,
        "productVat" => 21,
        "productCurrency" => "CZK",
        "productThumbnail" => "https://beta.apothekeonline.cz/img/thumbnail/w718-h718-z2/300/26/5b17c1159f4b3b76e6d96b99119dba69.jpg",
        "productdAvailabilityDate" => new DateTime(),
        "productBrand" => null,
        "productManufacturer" => "PARALEN",
        "productCategory" => "Zdraví a léky > Chřipka, nachlazení",
        "productIsbn" => null,
        "productEan" => null,
        "productNumber" => "paralen12x500mg",
    ]
];


foreach($data as $val) {

    $item = new HeurekaItem($val->productId);    
    $item->setProductName($val->productName);
    $item->setDescription($val->productDescription);
    $item->setUrl($val->productUrl);
    $item->setPriceVat($val->productPrice);       
    $item->addImage($val->productThumbnail);
    $item->addImage($val->productThumbnail); // toto je schvalne
    $item->addVatRate($val->productVat);
    $item->addIsbn($val->productIsbn);
    $item->addEan($val->productEan);
    $item->addManufacturer($val->productManufacturer);
    $item->addCategoryText($val->productCategory);
    $item->setDeliveryDate(0);
    
    // parametry
    $item->addParameter("velikost", "XL");
    $item->addParameter("velikost", "XXL");

    // doprava
    $item->addDelivery(new HeurekaDelivery(HeurekaDelivery::VLASTNI_PREPRAVA, 109));
    $item->addDelivery(new HeurekaDelivery(HeurekaDelivery::DHL, 109));
    
    // darky
    $item->addGift(new HeurekaGift("test-1", "párek"));
    $item->addGift(new HeurekaGift("test-2", "hořčice"));
   
    $generator->addItem($item);
}


// ulozeni, vystup
if(($_GET["action"] ?? "asDump") === "asSave") {
    
    echo "<pre>";
    print $generator->save("google.xml", "_formatXml");
    echo "</pre>";
    
} else {
    
    $generator->output("_formatXml");
}




















