<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Domain\Heureka\HeurekaConfig;

/**
 * @extends AbstractXmlFeedGenerator<HeurekaConfig>
 */
final class HeurekaGenerator extends AbstractXmlFeedGenerator
{
    protected function getRootName(): string
    {
        return 'SHOP';
    }

    protected function getRootAttributes(): array
    {
        return [
            'xmlns' => 'http://www.heureka.cz/ns/offer/1.0',
        ];
    }
}
