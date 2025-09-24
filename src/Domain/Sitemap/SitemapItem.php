<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Sitemap;

use Lemonade\Feed\Domain\DomainItemInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class SitemapItem implements DomainItemInterface
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

    public function getLoc(): string
    {
        return $this->loc;
    }

    public function getLastMod(): ?\DateTimeInterface
    {
        return $this->lastMod;
    }

    public function getChangeFreq(): ?string
    {
        return $this->changeFreq;
    }

    public function getPriority(): ?float
    {
        return $this->priority;
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
}
