<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Google;

/**
 * Reprezentace obrázku pro XML feed Google Merchant Center.
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrak <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
final class GoogleImage
{
    public function __construct(protected readonly ?string $url = null)
    {
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }
}