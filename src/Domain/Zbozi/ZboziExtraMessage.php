<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Zbozi;

use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;

final class ZboziExtraMessage implements XmlExportable
{
    public function __construct(
        private readonly string $type
    ) {}

    public function getType(): string
    {
        return $this->type;
    }

    public function toXml(XmlStreamWriter $xml): void
    {
        $xml->element('EXTRA_MESSAGE', $this->type);
    }
}
