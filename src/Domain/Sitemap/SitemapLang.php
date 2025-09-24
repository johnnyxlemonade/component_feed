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
    case ES = 'es';
    case IT = 'it';
    case PL = 'pl';
    case HU = 'hu';
    case PT = 'pt';
    case NL = 'nl';
    case RO = 'ro';
    case BG = 'bg';

    public static function fromOrDefault(?string $lang): self
    {
        foreach (self::cases() as $case) {
            if ($case->value === strtolower((string)$lang)) {
                return $case;
            }
        }
        return self::CS;
    }

    /**
     * Název jazyka pro zobrazení v menu
     */
    public function label(): string
    {
        return match ($this) {
            self::CS => 'Čeština',
            self::EN => 'English',
            self::DE => 'Deutsch',
            self::FR => 'Français',
            self::RU => 'Русский',
            self::SK => 'Slovenčina',
            self::ES => 'Español',
            self::IT => 'Italiano',
            self::PL => 'Polski',
            self::HU => 'Magyar',
            self::PT => 'Português',
            self::NL => 'Nederlands',
            self::RO => 'Română',
            self::BG => 'Български',
        };
    }
}
