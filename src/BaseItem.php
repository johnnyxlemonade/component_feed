<?php declare(strict_types = 1);

namespace Lemonade\Feed;

use ReflectionObject;
use ReflectionProperty;

/**
 * BaseItem
 *
 * Abstraktní datový objekt pro validaci pomocí @required anotací.
 *
 * Implementuje základní metody pro kontrolu povinných polí, určených
 * komentářovou anotací `@required` u veřejných vlastností. Potomci
 * musí definovat chybovou hlášku metodou `getErrorString()`.
 *
 * @package     Lemonade Framework
 * @link        https://lemonadeframework.cz/
 * @author      Honza Mudrak <honzamudrak@gmail.com>
 * @license     MIT
 * @since       1.0.0
 */
abstract class BaseItem implements ItemInterface
{
    /**
     * Error
     * #[\Override] (php 8.3+)
     */
    abstract public static function getErrorString(): string;

    /**
     * Validace
     * #[\Override] (php 8.3+)
     **/
    public function validate(): bool
    {
        foreach ($this->getRequiredProperties() as $property) {
            if ($this->isRequiredAndEmpty($property)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Vrátí seznam chybějících required polí
     * @return string[]
     */
    public function errors(): array
    {
        $errors = [];

        foreach ($this->getRequiredProperties() as $property) {
            if ($this->isRequiredAndEmpty($property)) {
                $errors[] = $property->getName();
            }
        }

        return $errors;
    }

    /**
     * Vrátí všechny veřejné vlastnosti označené jako @required
     *
     * @return ReflectionProperty[]
     */
    private function getRequiredProperties(): array
    {
        $ref = new ReflectionObject($this);

        return array_filter(
            $ref->getProperties(ReflectionProperty::IS_PUBLIC),
            fn(ReflectionProperty $property) =>
                $property->getDocComment() !== false &&
                preg_match('/^\s*\*\s*@required\b/m', $property->getDocComment()) === 1
        );
    }

    /**
     * Zjistí, zda je hodnota požadované vlastnosti "prázdná".
     *
     * @param ReflectionProperty $property
     * @return bool
     */
    private function isRequiredAndEmpty(ReflectionProperty $property): bool
    {
        /** @phpstan-ignore-next-line */
        $value = $this->{$property->getName()};

        return match (true) {
            $value === null => true,
            is_string($value) && trim($value) === '' => true,
            is_array($value) && $value === [] => true,
            $value instanceof \Countable && count($value) === 0 => true,
            default => false,
        };
    }
}
