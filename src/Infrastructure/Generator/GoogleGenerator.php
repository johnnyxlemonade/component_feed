<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Domain\Google\GoogleConfigDto;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;

final class GoogleGenerator extends AbstractXmlFeedGenerator
{
    public function __construct(
        private readonly GoogleConfigDto $config,
                                         ...$deps // filesystem, headers, stream
    ) {
        parent::__construct(...$deps);
    }

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
        $xml->start('channel');
        $xml->element('title', $this->config->shopTitle);
        $xml->element('link', $this->config->shopLink);
        $xml->element('description', $this->config->shopDescription);
    }

    protected function afterItems(XmlStreamWriter $xml): void
    {
        $xml->end('channel');
    }
}
