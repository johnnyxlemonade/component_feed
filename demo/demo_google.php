<?php



require __DIR__ . "/vendor/autoload.php";

// import NS
use Lemonade\Component\Feed\BaseStorage;
use Lemonade\Component\Feed\Data\Google\GoogleGenerator;
use Lemonade\Component\Feed\Data\Google\GoogleItem;
use Lemonade\Component\Feed\Data\Google\GoogleDelivery;

// generator
$generator = new GoogleGenerator(new BaseStorage(), "feed.test.localhost", "Feed web");

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
        "productCurrency" => "CZK",
        "productThumbnail" => "https://beta.apothekeonline.cz/img/thumbnail/w718-h718-z2/300/26/5b17c1159f4b3b76e6d96b99119dba69.jpg",
        "productType" => "new",
        "productStock" => "in stock",
        "productdAvailabilityDate" => new DateTime(),
        "productBrand" => null,
        "productCategory" => "Zdraví a léky > Chřipka, nachlazení",
        "productEan" => null,
        "productNumber" => "paralen12x400mg",
    ]
];


foreach($data as $val) {
    
    $item = new GoogleItem($val->productId);
    $item->setProductName($val->productName);
    $item->setDescription($val->productDescription);
    $item->setUrl($val->productUrl);
    $item->setPrice($val->productPrice);
    $item->addImage($val->productThumbnail);
    $item->addImage($val->productThumbnail); // toto je schvalne
    $item->setAvailability($val->productStock);
    $item->addAvailabilityDate($val->productdAvailabilityDate);
    $item->addBrand($val->productBrand);
    $item->addProductType($val->productCategory);
    
    if($val->productEan) {
        
        $item->addGtin($val->productEan);
        $item->setIdentifierExists(true);
        
    } else {
        
        $item->addMpn($val->productNumber);
        $item->setIdentifierExists(false);
    }

    // doprava
    $item->addDelivery(new GoogleDelivery("CZ", "PPL", 109, $item->getCurrency()));
    $item->addDelivery(new GoogleDelivery("CZ", "Vlastní přeprava", 50, $item->getCurrency()));
    
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




















