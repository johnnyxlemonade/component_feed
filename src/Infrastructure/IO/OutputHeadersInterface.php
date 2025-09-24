<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\IO;

/**
 * Společný základ pro všechny implementace hlaviček,
 * umožňuje pushnout libovolné vlastní hlavičky.
 */
interface OutputHeadersInterface
{
    public function pushXmlHeaders(): void;
    public function pushJsonHeaders(): void;
    /**
     * @param array<string,string> $headers
     */
    public function pushCustomHeaders(array $headers): void;
}
