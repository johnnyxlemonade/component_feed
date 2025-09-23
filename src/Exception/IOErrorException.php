<?php declare(strict_types=1);

namespace Lemonade\Feed\Exception;

/**
 * Výjimky pro IO operace (Filesystem, OutputHeaders, Stream).
 */
final class IOErrorException extends FeedException
{
    public const CODE_WRITE_FAILED  = 2001;
    public const CODE_READ_FAILED   = 2002;
    public const CODE_DELETE_FAILED = 2003;

    public static function writeFailed(string $path): self
    {
        return new self("Cannot write to file: $path", self::CODE_WRITE_FAILED);
    }

    public static function readFailed(string $path): self
    {
        return new self("Cannot read file: $path", self::CODE_READ_FAILED);
    }

    public static function deleteFailed(string $path): self
    {
        return new self("Cannot delete file: $path", self::CODE_DELETE_FAILED);
    }
}
