<?php declare(strict_types=1);

namespace Lemonade\Feed\Exception;

/**
 * Výjimka pro nevalidní položky feedu (chybí povinná pole, špatný formát apod.)
 */
final class InvalidFeedItemException extends FeedException
{
    public const CODE_MISSING_REQUIRED = 1001;
    public const CODE_INVALID_FORMAT   = 1002;

    public static function missingRequired(string $field): self
    {
        return new self(
            sprintf('Missing required field: %s', $field),
            self::CODE_MISSING_REQUIRED
        );
    }

    public static function invalidFormat(string $field, string $expected): self
    {
        return new self(
            sprintf('Invalid format for field "%s". Expected %s.', $field, $expected),
            self::CODE_INVALID_FORMAT
        );
    }
}
