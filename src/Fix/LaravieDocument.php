<?php declare(strict_types = 1);

namespace Lemonade\Feed\Fix;
use Illuminate\Support\Arr;
use Laravie\Parser\Xml\Document;
use Laravie\Parser\Xml\Definitions\MultiLevel;
use function Laravie\Parser\alias_get;
use SimpleXMLElement;

/**
 *
 */
class LaravieDocument extends Document
{

    /**
     * @param SimpleXMLElement $content
     * @param array $uses
     * @return array
     */
    protected function parseValueCollection(SimpleXMLElement $content, array $uses): array
    {
        $value = [];
        $result = [];

        foreach ($uses as $use) {
            $primary = $this->resolveUses($use);

            if ($primary instanceof MultiLevel) {

                $result[$primary->getKey()] = $this->parseMultiLevelsValueCollection($content, $primary);

                // standaFix
                $value = $result;

            } else {

                [$name, $as] = strpos($use, '>') !== false ? explode('>', $use, 2) : [$use, $use];

                if (preg_match('/^([A-Za-z0-9_\-\.]+)\((.*)\=(.*)\)$/', $name, $matches)) {

                    $as = alias_get($as, $name);
                    $item = $this->getSelfMatchingValue($content, $matches, $as);

                    if (\is_null($as)) {

                        $value = array_merge($value, $item);

                    } else {

                        Arr::set($value, $as, $item);
                    }

                } else {

                    $name = alias_get($name, '@');

                    Arr::set($value, $as, $this->getValue($content, $name));
                }

                $result = $value;
            }
        }

        return $result;
    }

}


