<?php declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Lemonade\Feed\Infrastructure\IO\{Filesystem, OutputHeaders, StreamFactory};
use Lemonade\Feed\Validator\FeedValidator;
use Lemonade\Feed\Logger\FeedLogger;
use Lemonade\Feed\FeedBuilder;
use Psr\Http\Message\StreamInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Level;

// základní cesta pro ukládání feedů (a XSL stylů)
$basePath = $_ENV['FEED_STORAGE_PATH'] ?? __DIR__;

// logger (Monolog -> FeedLogger)
$monolog = new Logger('feed');
$monolog->pushHandler(new StreamHandler($basePath . '/feed.log', Level::Debug));
$logger = new FeedLogger($monolog);

// služby
$filesystem    = new Filesystem($basePath, $logger);
$outputHeaders = new OutputHeaders();
$stream        = StreamFactory::createTempStream();
$validator     = new FeedValidator($logger);

// high-level builder
$builder = new FeedBuilder(
    $filesystem,
    $outputHeaders,
    $stream,
    $logger,
    $validator
);
