<?php declare(strict_types=1);

namespace Lemonade\Feed;

use Lemonade\Feed\Domain\FeedType;
use Lemonade\Feed\Infrastructure\Adapter\AdapterFactory;
use Lemonade\Feed\Domain\FeedConfigInterface;
use Lemonade\Feed\Validator\FeedValidatorInterface;
use Lemonade\Feed\Logger\FeedLoggerInterface;
use Lemonade\Feed\Infrastructure\IO\{FilesystemInterface, OutputHeadersInterface};
use Psr\Http\Message\StreamInterface;

final class FeedBuilder
{
    private GeneratorFactory $generatorFactory;
    private AdapterFactory $adapterFactory;

    public function __construct(
        FilesystemInterface $filesystem,
        OutputHeadersInterface $outputHeaders,
        StreamInterface $stream,
        FeedLoggerInterface $logger,
        private readonly FeedValidatorInterface $validator,
        ?AdapterFactory $adapterFactory = null
    ) {
        $this->generatorFactory = new GeneratorFactory(
            $filesystem,
            $outputHeaders,
            $stream,
            $logger
        );
        $this->adapterFactory = $adapterFactory ?? new AdapterFactory();
    }

    public function build(
        FeedType $type,
        FeedConfigInterface $config,
        iterable $items,
        FeedFormat $format = FeedFormat::XML
    ): void {
        $this->getGenerator($config, $format, $type)
            ->output($this->adaptItems($items, $format));
    }

    public function save(
        FeedType $type,
        FeedConfigInterface $config,
        string $filename,
        iterable $items,
        FeedFormat $format = FeedFormat::XML
    ): void {
        $this->getGenerator($config, $format, $type)
            ->save($filename, $this->adaptItems($items, $format));
    }

    public function stream(
        FeedType $type,
        FeedConfigInterface $config,
        iterable $items,
        FeedFormat $format = FeedFormat::XML
    ): StreamInterface {
        return $this->getGenerator($config, $format, $type)
            ->toStream($this->adaptItems($items, $format));
    }

    private function adaptItems(iterable $items, FeedFormat $format): iterable
    {
        foreach ($this->validator->validateStream($items) as $item) {
            yield $format->isJson()
                ? $this->adapterFactory->toJson($item)
                : $this->adapterFactory->toXml($item);
        }
    }

    private function getGenerator(FeedConfigInterface $config, FeedFormat $format, FeedType $type): object
    {
        return match ($type) {
            FeedType::SITEMAP => $format->isJson()
                ? $this->generatorFactory->createSitemapJson($config)
                : $this->generatorFactory->createSitemap($config),

            FeedType::GOOGLE => $format->isJson()
                ? $this->generatorFactory->createGoogleJson($config)
                : $this->generatorFactory->createGoogle($config),

            FeedType::ZBOZI => $format->isJson()
                ? $this->generatorFactory->createZboziJson($config)
                : $this->generatorFactory->createZbozi($config),

            FeedType::HEUREKA => $format->isJson()
                ? $this->generatorFactory->createHeurekaJson($config)
                : $this->generatorFactory->createHeureka($config),
        };
    }
}
