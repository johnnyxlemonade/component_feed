<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain;

/**
 * Společný kontrakt pro všechny feed konfigurace.
 * Umožňuje pracovat s různými feedy jednotně (registr, validace, logging).
 */
interface FeedConfigInterface
{
    /**
     * Jednoznačný identifikátor feedu
     */
    public function feedType(): FeedType;
}
