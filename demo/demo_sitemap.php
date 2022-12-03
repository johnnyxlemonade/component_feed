<?php



require __DIR__ . "/vendor/autoload.php";

// import NS
use Lemonade\Component\Feed\BaseStorage;
use Lemonade\Component\Feed\Data\Sitemap\SitemapGenerator;
use Lemonade\Component\Feed\Data\Sitemap\SitemapItem;



// generator
$generator = new SitemapGenerator(new BaseStorage(), "feed.test.localhost");

// data
$data = [
    ["loc" => "https://core1.agency", "freq" => "daily", "priority" => 1],
    ["loc" => "https://core1.agency/portfolio", "freq" => "daily", "priority" => 0.9]
];

foreach($data as $key => $val) {
    
    $item = new SitemapItem($key);
    $item->setLoc($val["loc"]);
    $item->setChangeFreq($val["freq"]);
    $item->setPriority($val["priority"]);

    $generator->addItem($item);
}

// ulozeni, vystup
if(($_GET["action"] ?? "asDump") === "asSave") {
    
    echo "<pre>";
    print $generator->save("sitemap.xml", "_formatXml");
    echo "</pre>";
    
} else {
    
    $generator->output("_formatXml");
}




















