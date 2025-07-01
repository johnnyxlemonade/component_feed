<?php declare(strict_types = 1);

namespace Lemonade\Feed;
use ReflectionObject;
use ReflectionProperty;

/**
 * Class BaseItem
 * @package Lemonade\Feed
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
     * Zjistí, zda je required vlastnost "prázdná"
     * Podporuje typy: null, prázdný string, prázdné pole, prázdný Countable objekt
     */
    private function isRequiredAndEmpty(ReflectionProperty $property): bool
    {
        /** @phpstan-ignore-next-line */
        $value = $this->{$property->getName()};

        if ($value === null) {
            return true;
        }

        if (is_string($value) && trim($value) === '') {
            return true;
        }

        if (is_array($value) && $value === []) {
            return true;
        }

        if ($value instanceof \Countable && count($value) === 0) {
            return true;
        }

        return false;
    }
}
