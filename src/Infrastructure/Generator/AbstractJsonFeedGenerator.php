<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\FeedFormat;
use Lemonade\Feed\Infrastructure\Json\JsonExportable;
use Lemonade\Feed\Infrastructure\Json\JsonStreamWriter;
use Lemonade\Feed\Infrastructure\Adapter\HasDomainItem;

/**
 * Abstrakce pro všechny JSON feed generátory
 *
 * @template T of JsonExportable
 */
abstract class AbstractJsonFeedGenerator extends AbstractFeedGenerator
{
    use FeedGeneratorCommon;

    /**
     * Zapíše jen pole itemů jako JSON array
     *
     * @param iterable<JsonExportable> $items
     */
    protected function writeItems(iterable $items): void
    {
        $writer = new JsonStreamWriter($this->getStream());
        $writer->startArray();

        foreach ($items as $item) {
            try {
                $writer->addItem($item->toJson());
            } catch (\Throwable $e) {
                $this->getLogger()->logInvalidItem(
                    $item instanceof HasDomainItem ? $item->getDomainItem() : null,
                    ['exception' => $e->getMessage()],
                );
            }
        }

        $writer->endArray();
    }

    /**
     * Obaluje kompletní JSON (konkrétní implementace v potomcích).
     *
     * @param iterable<JsonExportable> $items
     */
    abstract protected function generateWrapped(iterable $items): void;

    protected function generate(iterable $items): void
    {
        $this->generateWrapped($items);
    }

    protected function getContentType(): FeedFormat
    {
        return FeedFormat::JSON;
    }
}
