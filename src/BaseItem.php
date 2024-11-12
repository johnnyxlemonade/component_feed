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
     * @return bool
     */
    public function validate(): bool
    {

        $test = (new ReflectionObject($this));

        foreach ($test->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            // Check if the property has the @required annotation in its doc comment
            if ($property->getDocComment() && preg_match('/@required/', $property->getDocComment())) {
                // Check if the property is set and not null or empty
                if (empty($this->{$property->getName()})) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @return array
     */
    public function errors(): array
    {

        $data = [];
        $test = (new ReflectionObject($this));

        foreach ($test->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            // Check if the property has the @required annotation in its doc comment
            if ($property->getDocComment() && preg_match('/@required/', $property->getDocComment())) {
                // Check if the property is set and not null or empty
                if (empty($this->{$property->getName()})) {
                    $data[] = $property->getName();
                }
            }
        }

        return $data;
    }
}
