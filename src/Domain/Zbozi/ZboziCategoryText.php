<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Zbozi;

use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;

final class ZboziCategoryText implements XmlExportable
{
    public function __construct(
        private readonly string $text
    ) {}

    public function getText(): string
    {
        return $this->text;
    }

    public function toXml(XmlStreamWriter $xml): void
    {
        if ($this->text !== '') {
            $xml->element('CATEGORYTEXT', $this->text);
        }
    }
}
