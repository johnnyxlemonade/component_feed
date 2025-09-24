<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Domain\Google\GoogleConfig;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;

/**
 * @extends AbstractXmlFeedGenerator<GoogleConfig>
 */
final class GoogleGenerator extends AbstractXmlFeedGenerator
{
    protected function getRootName(): string
    {
        return 'rss';
    }

    protected function getRootAttributes(): array
    {
        return [
            'version' => '2.0',
            'xmlns:g' => 'http://base.google.com/ns/1.0',
        ];
    }

    protected function beforeItems(XmlStreamWriter $xml): void
    {
        $config = $this->getConfig();

        $xml->start('channel');
        $xml->element('title', $config->shopTitle());
        $xml->element('link', $config->shopLink());
        $xml->element('description', $config->shopDescription());
    }

    protected function afterItems(XmlStreamWriter $xml): void
    {
        $xml->end('channel');
    }
}
