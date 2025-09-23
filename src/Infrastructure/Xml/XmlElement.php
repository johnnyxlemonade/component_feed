<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Xml;

final class XmlElement implements XmlExportable
{
    /**
     * @param array<string,string> $attributes
     * @param array<XmlElement|null> $children
     */
    public function __construct(
        private readonly string $name,
        private readonly ?string $value = null,
        private readonly array $attributes = [],
        private readonly array $children = [],
        private readonly bool $cdata = false,
    ) {}

    public function toXml(XmlStreamWriter $xml): void
    {
        if ($this->children !== []) {
            $xml->start($this->name, $this->attributes);

            foreach ($this->children as $child) {
                if ($child !== null) {
                    $child->toXml($xml);
                }
            }

            $xml->end($this->name);
            return;
        }

        $xml->element($this->name, $this->value, $this->attributes, $this->cdata);
    }
}
