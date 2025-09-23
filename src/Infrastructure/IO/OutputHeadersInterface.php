<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\IO;

interface OutputHeadersInterface
{
    public function pushXmlHeaders(): void;

    /**
     * @param array<string,string> $headers
     */
    public function pushCustomHeaders(array $headers): void;
}
