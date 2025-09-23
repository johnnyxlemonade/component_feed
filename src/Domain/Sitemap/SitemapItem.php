<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Sitemap;

use Lemonade\Feed\Infrastructure\Xml\XmlExportable;
use Lemonade\Feed\Infrastructure\Xml\XmlStreamWriter;
use Symfony\Component\Validator\Constraints as Assert;

final class SitemapItem implements XmlExportable
{
    #[Assert\NotBlank]
    #[Assert\Url]
    private string $loc;

    private ?\DateTimeInterface $lastMod = null;

    #[Assert\Choice(choices: ["always","hourly","daily","weekly","monthly","yearly","never"])]
    private ?string $changeFreq = null;

    #[Assert\Range(min: 0.0, max: 1.0)]
    private ?float $priority = null;

    public function __construct(string $loc)
    {
        $this->loc = $loc;
    }

    public function setLastMod(?\DateTimeInterface $lastMod): self
    {
        $this->lastMod = $lastMod;
        return $this;
    }

    public function setChangeFreq(?string $freq): self
    {
        $this->changeFreq = $freq;
        return $this;
    }

    public function setPriority(?float $priority): self
    {
        $this->priority = $priority;
        return $this;
    }

    public function toXml(XmlStreamWriter $xml): void
    {
        $xml->start('url');

        $xml->element('loc', $this->loc);
        $xml->element('lastmod', $this->lastMod?->format('c'));
        $xml->element('changefreq', $this->changeFreq);
        $xml->element('priority', $this->priority !== null ? number_format($this->priority, 1) : null);

        $xml->end('url');
    }
}
