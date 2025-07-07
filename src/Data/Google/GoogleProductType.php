<?php declare(strict_types = 1);

namespace Lemonade\Feed\Data\Google;

/**
 * Reprezentace typu produktu pro XML feed Google Merchant Center.
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrak <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
final class GoogleProductType
{
    public function __construct(protected readonly ?string $text = null)
    {
    }

    public function getText(): ?string
    {
        return $this->text;
    }
}
