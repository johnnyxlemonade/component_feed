<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\IO;

use Lemonade\Feed\Exception\IOErrorException;

final class Filesystem implements FilesystemInterface
{
    public function write(string $path, string $contents): void
    {
        $ok = @file_put_contents($path, $contents);
        if ($ok === false) {
            throw IOErrorException::writeFailed($path);
        }
    }

    public function read(string $path): string
    {
        $data = @file_get_contents($path);
        if ($data === false) {
            throw IOErrorException::readFailed($path);
        }
        return $data;
    }

    public function exists(string $path): bool
    {
        return file_exists($path);
    }

    public function delete(string $path): void
    {
        if ($this->exists($path) && !@unlink($path)) {
            throw IOErrorException::deleteFailed($path);
        }
    }
}
