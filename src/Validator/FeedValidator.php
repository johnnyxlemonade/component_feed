<?php declare(strict_types=1);

namespace Lemonade\Feed\Validator;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Logger\FeedLoggerInterface;

final class FeedValidator implements FeedValidatorInterface
{
    private ValidatorInterface $validator;

    public function __construct(
        private readonly FeedLoggerInterface $logger,
        ?ValidatorInterface $validator = null
    ) {
        $this->validator = $validator ?? Validation::createValidatorBuilder()
            ->enableAttributeMapping()
            ->getValidator();
    }

    public function validateStream(iterable $items): \Generator
    {
        foreach ($items as $item) {
            $violations = $this->validator->validate($item);

            if (count($violations) > 0) {
                $errors = array_map(
                    fn($v) => sprintf('%s: %s', $v->getPropertyPath(), $v->getMessage()),
                    iterator_to_array($violations)
                );

                $this->logger->logInvalidItem($item, $errors);
                continue;
            }

            yield $item;
        }
    }
}
