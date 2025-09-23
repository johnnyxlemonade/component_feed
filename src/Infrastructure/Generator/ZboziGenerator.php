<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;

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

    protected function beforeItems(XmlStreamWriter $xml): void
    {
        // tady u Zbozi není nic speciálního před <SHOPITEM>
    }

    protected function afterItems(XmlStreamWriter $xml): void
    {
        // tady taky nic
    }
}
