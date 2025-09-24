<?php declare(strict_types=1);

namespace Lemonade\Feed\Validator;

use Lemonade\Feed\Infrastructure\Xml\XmlExportable;

interface FeedValidatorInterface
{
    /**
     * @param iterable<XmlExportable> $items
     * @return \Generator<XmlExportable>
     */
    public function validateStream(iterable $items): \Generator;
}
