<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain;

enum FeedType: string
{
    case SITEMAP = 'sitemap';
    case GOOGLE  = 'google';
    case ZBOZI   = 'zbozi';
    case HEUREKA = 'heureka';
}
