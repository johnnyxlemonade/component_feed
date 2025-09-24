<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Generator;

use Lemonade\Feed\Infrastructure\Json\JsonExportable;
use Lemonade\Feed\Infrastructure\Json\JsonStreamWriter;

/**
 * Abstrakce pro všechny JSON feed generátory
 */
abstract class AbstractJsonFeedGenerator extends AbstractFeedGenerator
{
    /**
     * Zapíše jen pole itemů jako JSON array [ {...}, {...} ]
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
                    ['exception' => $e->getMessage()]
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

    public function save(string $filename, iterable $items): void
    {
        $this->resetStream();
        $this->generateWrapped($items);

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
        $this->getHeaders()->pushJsonHeaders();

        $this->resetStream();
        $this->generateWrapped($items);

        $this->getStream()->rewind();
        echo $this->getStream()->getContents();
    }
}

