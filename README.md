# Lemonade Feed Component

**Lemonade Feed** is a PHP library for generating e-commerce feeds (Sitemap, Google Merchant, Zboží.cz, Heureka, …) in a **strictly typed, streaming, and framework-agnostic** way.

## ✨ Features

- ✅ Constant-memory streaming (no DOM trees)
- ✅ Strict typing (PHPStan level 10)
- ✅ Validation via Symfony Validator
- ✅ Unified API for XML / JSON
- ✅ Pluggable Adapters (domain → export)
- ✅ Easy to extend with new feeds
- ✅ Cross-format support (XML, JSON, CSV in future)
- ✅ Framework-agnostic – works anywhere
- ✅ Optional XSL stylesheets for Sitemap

---

## 🔧 Installation

```bash
composer require lemonade/component-feed
```

---

## 🚀 Usage with FeedBuilder

The main entrypoint is `FeedBuilder`.  
It orchestrates **validation → adaptation → generation**.

### Sitemap Example

```php
use Lemonade\Feed\FeedBuilder;
use Lemonade\Feed\Domain\{FeedType, Sitemap\SitemapConfig, Sitemap\SitemapLang};
use Lemonade\Feed\FeedFormat;
use Lemonade\Feed\Demo\SitemapFixture;

// prepare config & items
$config = new SitemapConfig(lang: SitemapLang::CS, createXsl: true);
$items = SitemapFixture::demo(100);

// build and send to browser
$builder->build(FeedType::SITEMAP, $config, $items, FeedFormat::XML);

// or save to file
$builder->save(FeedType::SITEMAP, $config, 'storage/0/sitemap.xml', $items);

// or get as PSR-7 Stream
$stream = $builder->stream(FeedType::SITEMAP, $config, $items, FeedFormat::JSON);
```

### Google Merchant

```php
use Lemonade\Feed\Domain\Google\GoogleConfig;
use Lemonade\Feed\Demo\GoogleFixture;

$config = GoogleConfig::create();
$items  = GoogleFixture::demo(100);

$builder->build(FeedType::GOOGLE, $config, $items);
```

### Zboží.cz

```php
use Lemonade\Feed\Domain\Zbozi\ZboziConfig;
use Lemonade\Feed\Demo\ZboziFixture;

$config = ZboziConfig::create();
$items  = ZboziFixture::demo(100);

$builder->build(FeedType::ZBOZI, $config, $items);
```

### Heureka

```php
use Lemonade\Feed\Domain\Heureka\HeurekaConfig;
use Lemonade\Feed\Demo\HeurekaFixture;

$config = HeurekaConfig::create();
$items  = HeurekaFixture::demo(100);

$builder->build(FeedType::HEUREKA, $config, $items);
```

---

## 📂 Examples

See the [`/examples`](./examples) folder for a working demo:

- [`index.php`](./examples/index.php) – simple router for trying feeds in browser
- [`bootstrap.php`](./examples/bootstrap.php) – builder & service setup

Run PHP built-in server:

```bash
php -S localhost:8000 -t examples
```

Then open [http://localhost:8000](http://localhost:8000) in your browser.

---

## 🧪 Testing

```bash
composer test
```

---

## 📜 License

MIT License © 2025 [LemonadeFramework.cz](https://lemonadeframework.cz/)
