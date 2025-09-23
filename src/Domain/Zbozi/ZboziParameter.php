<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Zbozi;

use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;

final class ZboziParameter implements XmlExportable
{
    public function __construct(
        private readonly string $name,
        private readonly string $value,
        private readonly ?string $unit = null,
    ) {}

    public function toXml(XmlStreamWriter $xml): void
    {
        $xml->start('PARAM');
        $xml->element('PARAM_NAME', $this->name);
        $xml->element('VAL', $this->value);
        $xml->element('UNIT', $this->unit);
        $xml->end('PARAM');
    }
}
