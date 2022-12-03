
```php 

require __DIR__ . "/vendor/autoload.php";

// import NS
use Lemonade\Feed\BaseStorage;
use Lemonade\Feed\Data\Heureka\HeurekaGenerator;
use Lemonade\Feed\Data\Heureka\HeurekaItem;

// fgenerator 
$generator = new HeurekaGenerator(new BaseStorage(), "feed.test.localhost", "Feed web");

// data
$data = range(1, 10);

foreach($data as $val) {
    
    $item = new HeurekaItem($val);
    $item->setProductName(sprintf("produkt-%d", $val));
    $item->setDescription(sprintf("description %d", $val));
    $item->setUrl(sprintf("/url-%d", $val));
    $item->setPriceVat(10);
    
    $generator->addItem($item);
}

$generator->output("_formatXml");