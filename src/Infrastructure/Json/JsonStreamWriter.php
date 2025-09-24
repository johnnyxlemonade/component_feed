<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Json;

use Psr\Http\Message\StreamInterface;

/**
 * Jednoduchý writer pro JSON stream.
 * Umožňuje zapisovat JSON array po položkách, bez nutnosti držet vše v paměti.
 */
final class JsonStreamWriter
{
    private bool $started = false;
    private bool $firstItem = true;

    public function __construct(
        private readonly StreamInterface $stream
    ) {}

    public function startArray(): void
    {
        if ($this->started) {
            throw new \RuntimeException('JSON array already started.');
        }
        $this->stream->write('[');
        $this->started = true;
    }

    /**
     * @param array<string,mixed> $data
     */
    public function addItem(array $data): void
    {
        if (!$this->started) {
            $this->startArray();
        }

        if (!$this->firstItem) {
            $this->stream->write(',');
        }

        $this->stream->write(
            json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );

        $this->firstItem = false;
    }

    public function endArray(): void
    {
        if (!$this->started) {
            return;
        }

        $this->stream->write(']');
        $this->started = false;
    }
}
