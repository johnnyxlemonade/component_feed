<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Zbozi;

use Lemonade\Feed\Domain\FeedConfigInterface;
use Lemonade\Feed\Domain\FeedType;

final class ZboziConfig implements FeedConfigInterface
{
    public static function create(): self
    {
        return new self();
    }

    public function feedType(): FeedType
    {
        return FeedType::ZBOZI;
    }
}
