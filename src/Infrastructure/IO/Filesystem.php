<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\IO;

use Lemonade\Feed\Exception\IOErrorException;
use Lemonade\Feed\Logger\FeedLoggerInterface;

final class Filesystem implements FilesystemInterface
{
    public function __construct(
        private readonly string $basePath,
        private readonly FeedLoggerInterface $logger
    ) {}

    public function resolvePath(string $path): string
    {
        if ($this->isAbsolute($path)) {
            return $path;
        }

        $clean = ltrim(str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path), DIRECTORY_SEPARATOR);

        return rtrim($this->basePath, DIRECTORY_SEPARATOR)
            . DIRECTORY_SEPARATOR
            . $clean;
    }

    public function isAbsolute(string $path): bool
    {
        // Linux: "/something"
        // Windows: "C:\something", "C:/something", UNC "\\server\share"
        return (bool) preg_match('~^(?:[A-Z]:[\\\\/]|/|\\\\\\\\)~i', $path);
    }

    public function mkdir(string $dir, int $mode = 0777): void
    {
        $dir = $this->resolvePath($dir);

        if (is_dir($dir)) {
            return;
        }

        if (!mkdir($dir, $mode, true) && !is_dir($dir)) {
            $this->logger->logGeneratorError(static::class, IOErrorException::mkdirFailed($dir));
            throw IOErrorException::mkdirFailed($dir);
        }
    }

    public function write(string $path, string $contents): void
    {
        $full = $this->resolvePath($path);

        $dir = dirname($full);
        if (!is_dir($dir)) {
            $this->mkdir($dir);
        }

        try {
            if (file_put_contents($full, $contents) === false) {
                throw IOErrorException::writeFailed($full);
            }
        } catch (\Throwable $e) {
            $this->logger->logGeneratorError(static::class, $e);
            throw $e;
        }
    }

    public function read(string $path): string
    {
        $full = $this->resolvePath($path);

        try {
            $data = file_get_contents($full);
            if ($data === false) {
                throw IOErrorException::readFailed($full);
            }
            return $data;
        } catch (\Throwable $e) {
            $this->logger->logGeneratorError(static::class, $e);
            throw $e;
        }
    }

    public function exists(string $path): bool
    {
        return file_exists($this->resolvePath($path));
    }

    public function isFile(string $path): bool
    {
        return is_file($this->resolvePath($path));
    }

    public function isDir(string $path): bool
    {
        return is_dir($this->resolvePath($path));
    }

    public function delete(string $path): void
    {
        $full = $this->resolvePath($path);

        if ($this->exists($path)) {
            try {
                if (!unlink($full)) {
                    throw IOErrorException::deleteFailed($full);
                }
            } catch (\Throwable $e) {
                $this->logger->logGeneratorError(static::class, $e);
                throw $e;
            }
        }
    }
}
