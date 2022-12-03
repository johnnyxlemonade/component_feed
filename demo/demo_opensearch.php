<?php



require __DIR__ . "/vendor/autoload.php";

// import NS
use Lemonade\Component\Feed\BaseStorage;
use Lemonade\Component\Feed\Data\OpenSearch\OpenSearchGenerator;
use Lemonade\Component\Feed\Data\OpenSearch\OpenSearchItem;

// generator
$generator = new OpenSearchGenerator(new BaseStorage(), "feed.test.localhost");

$item = new OpenSearchItem("defaultOpenSearch");
$item->setShortName("core1.agency");
$item->setLongName("Jedničková Digitální agentura core1");
$item->setDescription("Spojujeme offline a digitální strategii, UX/UI design, vývoj webu i e-commerce řešení. Přinášíme inovace a kompletní servis ve světě internetu i mimo něj.");
$item->setUrl("https://core1.agency");
$item->addImage(null);  

$generator->addItem($item);

// ulozeni, vystup
if(($_GET["action"] ?? "asDump") === "asSave") {
    
    echo "<pre>";
    print $generator->save("opensearch.xml", "_formatXml");
    echo "</pre>";
    
} else {
    
        $generator->output("_formatXml");    
    
}






