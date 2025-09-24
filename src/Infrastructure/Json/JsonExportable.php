<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Json;

/**
 * Kontrakt pro všechny položky exportovatelné do JSON feedu.
 */
interface JsonExportable
{
    /**
     * Vrátí JSON serializovatelná data (pole).
     *
     * @return array<string,mixed>
     */
    public function toJson(): array;
}
