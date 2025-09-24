<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\IO;

final class OutputHeaders implements
    XmlOutputHeadersInterface,
    JsonOutputHeadersInterface,
    OutputHeadersInterface
{
    public function pushXmlHeaders(): void
    {
        header('Content-Type: application/xml; charset=UTF-8');
    }

    public function pushJsonHeaders(): void
    {
        header('Content-Type: application/json; charset=UTF-8');
    }

    public function pushCustomHeaders(array $headers): void
    {
        foreach ($headers as $name => $value) {
            header($name . ': ' . $value);
        }
    }
}
