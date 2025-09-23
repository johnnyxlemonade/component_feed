<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

final class HeurekaGenerator extends AbstractXmlFeedGenerator
{
    protected function getRootName(): string
    {
        return 'SHOP';
    }
}
