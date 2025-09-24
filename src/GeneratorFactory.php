<?php declare(strict_types=1);

namespace Lemonade\Feed;

use Lemonade\Feed\Infrastructure\Generator\{
    SitemapGenerator, SitemapJsonGenerator,
    GoogleGenerator, GoogleJsonGenerator,
    ZboziGenerator, ZboziJsonGenerator,
    HeurekaGenerator, HeurekaJsonGenerator
};
use Lemonade\Feed\Domain\Sitemap\SitemapConfig;
use Lemonade\Feed\Domain\Google\GoogleConfig;
use Lemonade\Feed\Domain\Zbozi\ZboziConfig;
use Lemonade\Feed\Domain\Heureka\HeurekaConfig;
use Lemonade\Feed\Infrastructure\IO\FilesystemInterface;
use Lemonade\Feed\Infrastructure\IO\OutputHeadersInterface;
use Psr\Http\Message\StreamInterface;
use Lemonade\Feed\Logger\FeedLoggerInterface;

final class GeneratorFactory
{
    public function __construct(
        private readonly FilesystemInterface $filesystem,
        private readonly OutputHeadersInterface $outputHeaders,
        private readonly StreamInterface $stream,
        private readonly FeedLoggerInterface $logger
    ) {}

    public function createSitemap(SitemapConfig $config): SitemapGenerator
    {
        return new SitemapGenerator($config, $this->filesystem, $this->outputHeaders, $this->stream, $this->logger);
    }

    public function createSitemapJson(SitemapConfig $config): SitemapJsonGenerator
    {
        return new SitemapJsonGenerator($config, $this->filesystem, $this->outputHeaders, $this->stream, $this->logger);
    }

    public function createGoogle(GoogleConfig $config): GoogleGenerator
    {
        return new GoogleGenerator($config, $this->filesystem, $this->outputHeaders, $this->stream, $this->logger);
    }

    public function createGoogleJson(GoogleConfig $config): GoogleJsonGenerator
    {
        return new GoogleJsonGenerator($config, $this->filesystem, $this->outputHeaders, $this->stream, $this->logger);
    }

    public function createZbozi(ZboziConfig $config): ZboziGenerator
    {
        return new ZboziGenerator($config, $this->filesystem, $this->outputHeaders, $this->stream, $this->logger);
    }

    public function createZboziJson(ZboziConfig $config): ZboziJsonGenerator
    {
        return new ZboziJsonGenerator($config, $this->filesystem, $this->outputHeaders, $this->stream, $this->logger);
    }

    public function createHeureka(HeurekaConfig $config): HeurekaGenerator
    {
        return new HeurekaGenerator($config, $this->filesystem, $this->outputHeaders, $this->stream, $this->logger);
    }

    public function createHeurekaJson(HeurekaConfig $config): HeurekaJsonGenerator
    {
        return new HeurekaJsonGenerator($config, $this->filesystem, $this->outputHeaders, $this->stream, $this->logger);
    }
}
