<?php declare(strict_types=1);

namespace Lemonade\Feed\Demo;

use Lemonade\Feed\Domain\Sitemap\SitemapItem;

final class SitemapFixture
{
    /**
     * @return iterable<SitemapItem>
     */
    public static function demo(int $count = 1000): iterable
    {
        // první validní
        yield (new SitemapItem('https://example.com/'))
            ->setLastMod(new \DateTimeImmutable())
            ->setChangeFreq('daily')
            ->setPriority(1.0);

        // schválně nevalidní (kvůli validator testu)
        yield new SitemapItem('not-a-url');

        // zbytek (simulace velkého datasetu)
        for ($i = 1; $i <= $count; $i++) {
            yield (new SitemapItem("https://example.com/page-$i"))
                ->setLastMod(new \DateTimeImmutable())
                ->setChangeFreq('weekly')
                ->setPriority(0.8);
        }
    }
}
