<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Xml;

use Psr\Http\Message\StreamInterface;

final class XmlStreamWriter
{
    public function __construct(private readonly StreamInterface $stream) {}

    public function declaration(string $version = '1.0', string $encoding = 'UTF-8'): void
    {
        $this->write(sprintf('<?xml version="%s" encoding="%s"?>', $version, $encoding));
    }

    /**
     * @param array<string,string> $attributes
     */
    public function start(string $name, array $attributes = []): void
    {
        $this->write('<' . $name . $this->formatAttributes($attributes) . '>');
    }

    public function end(string $name): void
    {
        $this->write('</' . $name . '>');
    }

    /**
     * @param array<string,string> $attributes
     */
    public function element(string $name, ?string $value, array $attributes = [], bool $cdata = false): void
    {
        if ($value === null || $value === '') {
            return;
        }

        if ($cdata) {
            $this->write(sprintf(
                '<%s%s><![CDATA[%s]]></%s>',
                $name,
                $this->formatAttributes($attributes),
                $value,
                $name
            ));
            return;
        }

        $this->write(sprintf(
            '<%1$s%2$s>%3$s</%1$s>',
            $name,
            $this->formatAttributes($attributes),
            htmlspecialchars($value, ENT_XML1 | ENT_COMPAT, 'UTF-8')
        ));
    }

    /**
     * Processing Instruction – např. xml-stylesheet
     */
    public function pi(string $target, string $data): void
    {
        $this->stream->write(sprintf('<?%s %s?>', $target, $data));
    }

    private function write(string $xml): void
    {
        $this->stream->write($xml);
    }

    /**
     * @param array<string,string> $attributes
     */
    private function formatAttributes(array $attributes): string
    {
        if ($attributes === []) {
            return '';
        }

        $parts = [];
        foreach ($attributes as $k => $v) {
            $parts[] = sprintf(
                '%s="%s"',
                $k,
                htmlspecialchars((string)$v, ENT_XML1 | ENT_COMPAT, 'UTF-8')
            );
        }

        return ' ' . implode(' ', $parts);
    }
}
