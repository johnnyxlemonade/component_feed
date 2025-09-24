# 🍋 Lemonade Feed Generator

A lightweight PHP library for generating product feeds (XML, stream-based) for Czech & international platforms.

✅ **Constant-memory streaming** – no giant DOM trees  
✅ **Strict typing & Symfony Validator**  
✅ **Extensible generators** – Sitemap, Google Merchant, Zboží.cz, Heureka, Money, Pohoda  
✅ **Optional XSL stylesheets** for pretty sitemaps with translations (cs/en/de/fr/ru/sk)  
✅ **DTO + VO architecture** for clean domain models  
✅ **Cross-format support (XML today, JSON coming soon)** – modern integrations with multiple feed formats  
✅ **Easy integration with any framework** – fully framework-agnostic (works with Symfony, Nette, Laravel, or plain PHP) thanks to PSR-7 and attributes

---

## 🚀 Installation

```bash
  composer require lemonade/component_feed
```

---

## 📑 Supported feeds

- **Sitemap** (`urlset`)
- **Google Merchant** (`rss/channel`)
- **Zboží.cz** (`SHOP/SHOPITEM`)
- **Heureka** (`SHOP/SHOPITEM`)
- **Money** (orders)
- **Pohoda** (orders, invoices)

---

## 🔧 Usage examples
### Sitemap

```php
use Lemonade\Feed\Domain\Sitemap\SitemapItem;
use Lemonade\Feed\Infrastructure\Generator\SitemapGenerator;
use Lemonade\Feed\Infrastructure\IO\Filesystem;
use Lemonade\Feed\Infrastructure\IO\OutputHeaders;
use Lemonade\Feed\Infrastructure\IO\StreamFactory;
use Lemonade\Feed\Validator\FeedValidator;

$stream     = StreamFactory::createTempStream();
$generator  = new SitemapGenerator(false, '/sitemap.xsl', 'cs', new Filesystem(), new OutputHeaders(), $stream);
$validator  = new FeedValidator();

$items = [
    (new SitemapItem('https://example.com/'))
        ->setLastMod(new DateTimeImmutable())
        ->setChangeFreq('daily')
        ->setPriority(1.0),
    new SitemapItem('not-a-url'), // invalid -> skipped
    (new SitemapItem('https://example.com/about'))
        ->setChangeFreq('monthly')
        ->setPriority(0.5),
];

// Output valid items to browser
$generator->output(
    $validator->validateStream($items)
);
```


### Google Merchant

```php
use Lemonade\Feed\Domain\Google\GoogleItem;
use Lemonade\Feed\Domain\Google\GoogleShipping;
use Lemonade\Feed\Domain\Google\GoogleImage;
use Lemonade\Feed\Domain\Google\GoogleProductType;
use Lemonade\Feed\Infrastructure\Generator\GoogleGenerator;

// create generator
$generator = new GoogleGenerator(
    'My Shop',
    'https://example.com',
    'Google Merchant Feed',
    new Filesystem(),
    new OutputHeaders(),
    $stream
);

// one item
$item = (new GoogleItem(
    'SKU123',
    'Super Produkt',
    'Popis produktu...',
    'https://example.com/product',
    199.99,
    'CZK'
))
    ->addShipping(new GoogleShipping('CZ', 'PPL', 89.00, 'CZK'))
    ->addImage(new GoogleImage('https://example.com/img.jpg'))
    ->addProductType(new GoogleProductType('Elektronika'))
    ->setBrand('Lemonade');

// export
$generator->output([$item]);
```

### Zboží.cz

```php
use Lemonade\Feed\Domain\Zbozi\ZboziItem;
use Lemonade\Feed\Domain\Zbozi\ZboziDelivery;
use Lemonade\Feed\Domain\Zbozi\ZboziImage;
use Lemonade\Feed\Domain\Zbozi\ZboziParameter;
use Lemonade\Feed\Infrastructure\Generator\ZboziGenerator;

// create generator
$generator = new ZboziGenerator(
    new Filesystem(),
    new OutputHeaders(),
    $stream
);

// one item
$item = (new ZboziItem('Super Produkt', 'Popis produktu...', 'https://example.com/product', 199.99))
    ->setItemId('SKU123')
    ->setDeliveryDate(0)
    ->addDelivery(new ZboziDelivery('PPL', 89.00))
    ->addImage(new ZboziImage('https://example.com/img.jpg'))
    ->addParameter(new ZboziParameter('Barva', 'Černá'))
    ->setEan('1234567890123')
    ->setManufacturer('Lemonade');

// export
$generator->output([$item]);
```

### Heureka


```php
use Lemonade\Feed\Domain\Heureka\HeurekaItem;
use Lemonade\Feed\Domain\Heureka\HeurekaDelivery;
use Lemonade\Feed\Domain\Heureka\HeurekaImage;
use Lemonade\Feed\Domain\Heureka\HeurekaParameter;
use Lemonade\Feed\Infrastructure\Generator\HeurekaGenerator;

// create generator
$generator = new HeurekaGenerator(
    new Filesystem(),
    new OutputHeaders(),
    $stream
);

// one item
$item = (new HeurekaItem('Super Produkt', 'Popis produktu...', 'https://example.com/product', 199.99))
    ->setItemId('SKU123')
    ->setDeliveryDate(0)
    ->addDelivery(new HeurekaDelivery('PPL', 89.00))
    ->addImage(new HeurekaImage('https://example.com/img.jpg'))
    ->addParameter(new HeurekaParameter('Barva', 'Černá'))
    ->setEan('1234567890123')
    ->setManufacturer('Lemonade');

// export
$generator->output([$item]);
```

---
## 🧪 Development & Testing

- PHPStan level 10 (strict)
- PHPUnit tests in `tests/`
- Fixtures for demo feeds in `src/Feed/Demo/`

---

## 📝 Roadmap

- [x] Sitemap (with optional XSL + i18n)
- [x] Google Merchant
- [x] Zboží.cz
- [x] Heureka
- [ ] Pohoda orders/invoices
- [ ] Money S5 orders
- [ ] JSON/CSV support
- [ ] Tests

---

## 📖 Changelog
All notable changes are documented in the [CHANGELOG.md](CHANGELOG.md).

## 📜 License
Released under the [MIT License](LICENSE).  
Copyright © 2025 Jan Mudrák
