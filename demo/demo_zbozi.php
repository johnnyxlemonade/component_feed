<?php



require __DIR__ . "/vendor/autoload.php";

// import NS
use Lemonade\Component\Feed\BaseStorage;
use Lemonade\Component\Feed\Data\Zbozi\ZboziGenerator;
use Lemonade\Component\Feed\Data\Zbozi\ZboziItem;
use Lemonade\Component\Feed\Data\Zbozi\ZboziDelivery;

// generator
$generator = new ZboziGenerator(new BaseStorage(), "feed.test.localhost", "Feed web");

// data
$data = [
    (object) [
        "productId" => 1,
        "productName" => "Paralen 12x500mg",
        "productDescription" => "Ke snížení horečky a bolesti při chřipce, nachlazení a jiných infekčních onemocněních. Dále při bolestech hlavy, zubů, bolestivé menstruaci, bolesti v krku a bolesti pohybového ústrojí provázející chřipku a nachlazení.",
        "productUrl" => "https://core1.agency",
        "productPrice" => 109,
        "productCurrency" => "CZK",
        "productThumbnail" => "https://beta.apothekeonline.cz/img/thumbnail/w718-h718-z2/300/26/5b17c1159f4b3b76e6d96b99119dba69.jpg",
        "productType" => "new",
        "productStock" => "in stock",
        "productdAvailabilityDate" => new DateTime(),
        "productBrand" => null,
        "productManufacturer" => null,
        "productCategory" => "Zdraví a léky > Chřipka, nachlazení",
        "productEan" => null,
        "productNumber" => "paralen12x500mg",
    ],
    (object) [
        "productId" => 2,
        "productName" => "Paralen 24x500mg",
        "productDescription" => "Ke snížení horečky a bolesti při chřipce, nachlazení a jiných infekčních onemocněních. Dále při bolestech hlavy, zubů, bolestivé menstruaci, bolesti v krku a bolesti pohybového ústrojí provázející chřipku a nachlazení.",
        "productUrl" => "https://core1.agency",
        "productPrice" => 109,
        "productListPrice" => 120,
        "productCurrency" => "CZK",
        "productThumbnail" => "https://beta.apothekeonline.cz/img/thumbnail/w718-h718-z2/300/26/5b17c1159f4b3b76e6d96b99119dba69.jpg",
        "productType" => "new",
        "productStock" => "in stock",
        "productdAvailabilityDate" => new DateTime(),
        "productBrand" => "Paralen",
        "productManufacturer" => "Zentiva ČR",
        "productCategory" => "Zdraví a léky > Chřipka, nachlazení",
        "productEan" => null,
        "productNumber" => null
    ]
];

foreach($data as $val) {
    
    $item = new ZboziItem($val->productId);
    $item->setProductName($val->productName);
    $item->setDescription($val->productDescription);
    $item->setUrl($val->productUrl);
    $item->setPriceVat($val->productPrice);
    $item->setDeliveryDate($val->productdAvailabilityDate);    
    $item->addImage($val->productThumbnail);    
    $item->addProductNo($val->productNumber);
    $item->addProduct($val->productName);
    $item->addManufacturer($val->productManufacturer);
    $item->addBrand($val->productBrand);
    $item->addEan($val->productEan);
       
    if(property_exists($val, "productListPrice")) {
        $item->addListPrice($val->productListPrice);
    }
    

    // doprava
    $item->addDelivery(new ZboziDelivery(ZboziDelivery::PPL, 109));
    $item->addDelivery(new ZboziDelivery(ZboziDelivery::PPL, 50));
    
    $generator->addItem($item);
}


// ulozeni, vystup
if(($_GET["action"] ?? "asDump") === "asSave") {
    
    echo "<pre>";
    print $generator->save("zbozi.xml", "_formatXml");
    echo "</pre>";
    
} else {
    
    $generator->output("_formatXml");
}




















