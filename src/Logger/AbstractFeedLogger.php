<?php declare(strict_types=1);

namespace Lemonade\Feed\Logger;

use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Psr\Log\AbstractLogger;
use Throwable;

abstract class AbstractFeedLogger extends AbstractLogger implements FeedLoggerInterface
{
    public function logInvalidItem(XmlExportable $item, array $errors = []): void
    {
        $this->warning('Invalid feed item', [
            'itemClass' => $item::class,
            'errors'    => $errors,
        ]);
    }

    public function logXslError(string $href, string $lang, Throwable $e): void
    {
        $this->error('Failed to write XSL', [
            'href'  => $href,
            'lang'  => $lang,
            'error' => $e->getMessage(),
        ]);
    }

    public function logGeneratorError(string $generator, Throwable $e): void
    {
        $this->critical('Generator error', [
            'generator' => $generator,
            'error'     => $e->getMessage(),
            'trace'     => $e->getTraceAsString(),
        ]);
    }
}
