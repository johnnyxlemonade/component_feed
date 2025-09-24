<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Heureka;

use Lemonade\Feed\Domain\FeedConfigInterface;
use Lemonade\Feed\Domain\FeedType;

final class HeurekaConfig implements FeedConfigInterface
{
    public static function create(): self
    {
        return new self();
    }

    public function feedType(): FeedType
    {
        return FeedType::HEUREKA;
    }
}
