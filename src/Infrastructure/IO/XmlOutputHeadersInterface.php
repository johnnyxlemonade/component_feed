<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\IO;

interface XmlOutputHeadersInterface
{
    public function pushXmlHeaders(): void;
}
