<?php declare(strict_types=1);

namespace Lemonade\Feed\Validator;

use Lemonade\Feed\Infrastructure\Xml\XmlExportable;

/**
 * No-op validátor, který neprovádí žádnou validaci.
 * Vhodné pro testy nebo prostředí, kde nechceme spouštět Symfony Validator.
 */
final class NullFeedValidator implements FeedValidatorInterface
{
    /**
     * @param iterable<XmlExportable> $items
     * @return \Generator<XmlExportable>
     */
    public function validateStream(iterable $items): \Generator
    {
        foreach ($items as $item) {
            yield $item;
        }
    }
}
