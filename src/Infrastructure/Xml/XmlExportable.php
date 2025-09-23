<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Xml;

interface XmlExportable
{
    public function toXml(XmlStreamWriter $xml): void;
}
