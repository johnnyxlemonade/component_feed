<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Infrastructure\Adapter\HasDomainItem;
use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;

/**
 * Abstrakce pro všechny XML feed generátory
 */
abstract class AbstractXmlFeedGenerator extends AbstractFeedGenerator
{
    /**
     * Název root elementu (např. <urlset>, <SHOP>, <rss>).
     */
    abstract protected function getRootName(): string;

    /**
     * Volitelné atributy root elementu (např. xmlns).
     *
     * @return array<string,string>
     */
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
    public function generate(iterable $items): void
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

    public function save(string $filename, iterable $items): void
    {
        $this->generate($items);
        $this->getStream()->rewind();
        $content = $this->getStream()->getContents();

        try {
            $this->getFilesystem()->write($filename, $content);
        } catch (\Throwable $e) {
            $this->getLogger()->logGeneratorError(static::class, $e);
        }
    }

    public function output(iterable $items): void
    {
        $this->getHeaders()->pushXmlHeaders();

        $this->generate($items);
        $this->getStream()->rewind();
        echo $this->getStream()->getContents();
    }
}
