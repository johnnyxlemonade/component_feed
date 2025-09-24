<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Domain\Zbozi\ZboziConfig;

/**
 * @extends AbstractXmlFeedGenerator<ZboziConfig>
 */
final class ZboziGenerator extends AbstractXmlFeedGenerator
{
    protected function getRootName(): string
    {
        return 'SHOP';
    }

    protected function getRootAttributes(): array
    {
        return [
            'xmlns' => 'http://www.zbozi.cz/ns/offer/1.0',
        ];
    }
}
