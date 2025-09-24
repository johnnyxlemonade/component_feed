<?php declare(strict_types=1);

namespace Lemonade\Feed\Validator;

use Lemonade\Feed\Domain\DomainItemInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
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

    /**
     * @template T of object
     * @param iterable<T> $items
     * @return \Generator<T>
     */
    public function validateStream(iterable $items): \Generator
    {
        $index = 0;

        foreach ($items as $item) {
            $index++;

            if (!$item instanceof DomainItemInterface) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Item #%d (%s) is not a valid DomainItemInterface',
                        $index,
                        get_class($item)
                    )
                );
            }

            $violations = $this->validator->validate($item);

            if (count($violations) > 0) {
                $errors = array_map(
                    fn($v) => sprintf(
                        '[Item #%d] %s: %s (value: %s)',
                        $index,
                        $v->getPropertyPath(),
                        $v->getMessage(),
                        var_export($v->getInvalidValue(), true)
                    ),
                    iterator_to_array($violations)
                );

                $this->logger->logInvalidItem($item, $errors);
                continue;
            }

            yield $item;
        }
    }
}
