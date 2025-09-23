<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\IO;

interface FilesystemInterface
{
    public function write(string $path, string $contents): void;

    public function read(string $path): string;

    public function exists(string $path): bool;

    public function delete(string $path): void;
}
