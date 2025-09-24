<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter; // Ujistěte se, že je tato třída naimportována!

final class HeurekaGenerator extends AbstractXmlFeedGenerator
{
    protected function getRootName(): string
    {
        return 'SHOP'; // Heureka používá SHOP jako kořenový tag
    }

    protected function getRootAttributes(): array
    {
        return [
            'xmlns' => 'http://www.heureka.cz/ns/offer/1.0', // Heureka namespace
        ];
    }
}
