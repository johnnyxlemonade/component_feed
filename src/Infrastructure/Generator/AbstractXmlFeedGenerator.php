<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\FeedFormat;
use Lemonade\Feed\Infrastructure\Adapter\HasDomainItem;
use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;

/**
 * Abstrakce pro všechny XML feed generátory
 *
 * @template T of XmlExportable
 */
abstract class AbstractXmlFeedGenerator extends AbstractFeedGenerator
{
    use FeedGeneratorCommon;

    abstract protected function getRootName(): string;

    /** @return array<string,string> */
    protected function getRootAttributes(): array
    {
        return [];
    }

    protected function beforeRoot(XmlStreamWriter $xml): void {}
    protected function beforeItems(XmlStreamWriter $xml): void {}
    protected function afterItems(XmlStreamWriter $xml): void {}

    /**
     * @param iterable<XmlExportable> $items
     */
    protected function generate(iterable $items): void
    {
        $this->resetStream();

        $writer = new XmlStreamWriter($this->getStream());
        $writer->declaration();

        $this->beforeRoot($writer);
        $writer->start($this->getRootName(), $this->getRootAttributes());

        $this->beforeItems($writer);

        foreach ($items as $item) {
            try {
                $item->toXml($writer);
            } catch (\Throwable $e) {
                $domain = $item instanceof HasDomainItem ? $item->getDomainItem() : $item;
                $this->getLogger()->logInvalidItem($domain, [
                    'exception' => $e->getMessage(),
                ]);
            }
        }

        $this->afterItems($writer);
        $writer->end($this->getRootName());
    }

    protected function getContentType(): FeedFormat
    {
        return FeedFormat::XML;
    }
}
