<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Zbozi;

use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;

final class ZboziImage implements XmlExportable
{
    public function __construct(
        private readonly string $url
    ) {}

    public function getUrl(): string
    {
        return $this->url;
    }

    public function toXml(XmlStreamWriter $xml): void
    {
        $xml->element('IMGURL', $this->url);
    }
}
