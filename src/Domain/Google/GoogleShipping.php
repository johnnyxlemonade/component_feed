<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Google;

use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;

final class GoogleShipping implements XmlExportable
{
    public function __construct(
        private string $country,
        private string $service,
        private float $price,
        private string $currency
    ) {}

    public function toXml(XmlStreamWriter $xml): void
    {
        $xml->start('g:shipping');
        $xml->element('g:country', $this->country);
        $xml->element('g:service', $this->service);
        $xml->element('g:price', sprintf('%.2f %s', $this->price, $this->currency));
        $xml->end('g:shipping');
    }
}
