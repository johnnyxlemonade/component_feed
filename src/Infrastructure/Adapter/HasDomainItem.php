<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Adapter;

use Lemonade\Feed\Domain\DomainItemInterface;

interface HasDomainItem
{
    public function getDomainItem(): DomainItemInterface;
}
