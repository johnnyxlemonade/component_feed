<?php declare(strict_types=1);

global $builder;

require __DIR__ . '/bootstrap.php';

use Lemonade\Feed\Domain\FeedType;
use Lemonade\Feed\Domain\Sitemap\SitemapConfig;
use Lemonade\Feed\Domain\Sitemap\SitemapLang;
use Lemonade\Feed\Domain\Google\GoogleConfig;
use Lemonade\Feed\Domain\Zbozi\ZboziConfig;
use Lemonade\Feed\Domain\Heureka\HeurekaConfig;
use Lemonade\Feed\Demo\{SitemapFixture, GoogleFixture, ZboziFixture, HeurekaFixture};
use Lemonade\Feed\FeedFormat;

$action = $_GET['action'] ?? 'index';
$format = FeedFormat::tryFrom($_GET['format'] ?? 'xml') ?? FeedFormat::XML;
$limit  = 100;

switch ($action) {
    case 'sitemap':
        $config = SitemapConfig::create(
            withXsl: true,
            lang: $_GET['lang'] ?? SitemapLang::CS->value,
            xslHref: '/storage/0/sitemap.xsl'
        );
        $items = SitemapFixture::demo($limit);
        $builder->build(FeedType::SITEMAP, $config, $items, $format);
        break;

    case 'google':
        $config = GoogleConfig::create();
        $items  = GoogleFixture::demo($limit);
        $builder->build(FeedType::GOOGLE, $config, $items, $format);
        break;

    case 'zbozi':
        $config = ZboziConfig::create();
        $items  = ZboziFixture::demo($limit);
        $builder->build(FeedType::ZBOZI, $config, $items, $format);
        break;

    case 'heureka':
        $config = HeurekaConfig::create();
        $items  = HeurekaFixture::demo($limit);
        $builder->build(FeedType::HEUREKA, $config, $items, $format);
        break;

    default:
        echo "<ul>
            <li><a href='?action=sitemap&format=xml'>Sitemap (XML)</a></li>
            <li><a href='?action=sitemap&format=json'>Sitemap (JSON)</a></li>
            <li><a href='?action=google&format=xml'>Google Merchant (XML)</a></li>
            <li><a href='?action=google&format=json'>Google Merchant (JSON)</a></li>
            <li><a href='?action=zbozi&format=xml'>Zboží.cz (XML)</a></li>
            <li><a href='?action=zbozi&format=json'>Zboží.cz (JSON)</a></li>
            <li><a href='?action=heureka&format=xml'>Heureka (XML)</a></li>
            <li><a href='?action=heureka&format=json'>Heureka (JSON)</a></li>
        </ul>";
}
