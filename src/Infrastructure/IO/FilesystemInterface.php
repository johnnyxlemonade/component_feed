<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\IO;

interface FilesystemInterface
{
    public function resolvePath(string $path): string;

    public function isAbsolute(string $path): bool;

    public function mkdir(string $dir, int $mode = 0777): void;

    public function write(string $path, string $contents): void;

    public function read(string $path): string;

    public function exists(string $path): bool;

    public function isFile(string $path): bool;

    public function isDir(string $path): bool;

    public function delete(string $path): void;
}
