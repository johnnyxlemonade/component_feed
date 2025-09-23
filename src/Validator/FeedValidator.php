<?php declare(strict_types=1);

namespace Lemonade\Feed\Validator;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Lemonade\Feed\Infrastructure\Xml\XmlExportable;

final class FeedValidator
{
    private ValidatorInterface $validator;

    public function __construct(?ValidatorInterface $validator = null)
    {
        $this->validator = $validator ?? Validation::createValidatorBuilder()
            ->enableAttributeMapping() // místo annotationMapping
            ->getValidator();
    }

    /**
     * @param iterable<XmlExportable> $items
     * @return \Generator<XmlExportable>
     */
    public function validateStream(iterable $items): \Generator
    {
        foreach ($items as $item) {
            $violations = $this->validator->validate($item);

            if (count($violations) > 0) {
                error_log(sprintf(
                    "Invalid feed item (%s): %s",
                    $item::class,
                    (string) $violations
                ));
                continue; // přeskočí invalidní
            }

            yield $item;
        }
    }
}
