<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\IO;

interface JsonOutputHeadersInterface
{
    public function pushJsonHeaders(): void;
}
