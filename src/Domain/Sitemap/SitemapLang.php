<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Sitemap;

enum SitemapLang: string
{
    case CS = 'cs';
    case EN = 'en';
    case DE = 'de';
    case FR = 'fr';
    case RU = 'ru';
    case SK = 'sk';

    public static function fromOrDefault(?string $lang): self
    {
        if ($lang === null) {
            return self::CS;
        }

        foreach (self::cases() as $case) {
            if ($case->value === $lang) {
                return $case;
            }
        }

        return self::CS;
    }
}
