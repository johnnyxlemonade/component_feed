<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\IO;

use Psr\Http\Message\StreamInterface;

/**
 * Továrna na PSR-7 StreamInterface.
 * Umožňuje snadné testování (může se mockovat).
 */
final class StreamFactory
{
    public static function createFromString(string $content = ''): StreamInterface
    {
        $resource = fopen('php://temp', 'r+');
        if ($content !== '') {
            fwrite($resource, $content);
            rewind($resource);
        }

        return new \Nyholm\Psr7\Stream($resource);
    }

    public static function createTempStream(): StreamInterface
    {
        $resource = fopen('php://temp', 'r+');
        return new \Nyholm\Psr7\Stream($resource);
    }

    public static function createFileStream(string $path, string $mode = 'w+'): StreamInterface
    {
        $resource = fopen($path, $mode);
        return new \Nyholm\Psr7\Stream($resource);
    }
}
