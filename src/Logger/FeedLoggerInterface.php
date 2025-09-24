<?php declare(strict_types=1);

namespace Lemonade\Feed\Logger;

use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Psr\Log\LoggerInterface;
use Throwable;

interface FeedLoggerInterface extends LoggerInterface
{
    /**
     * Zaloguje nevalidní položku feedu
     */
    public function logInvalidItem(XmlExportable $item, array $errors = []): void;

    /**
     * Zaloguje chybu při zápisu XSL souboru
     */
    public function logXslError(string $href, string $lang, Throwable $e): void;

    /**
     * Zaloguje obecnou chybu generátoru
     */
    public function logGeneratorError(string $generator, Throwable $e): void;
}
