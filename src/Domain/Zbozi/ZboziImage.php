<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Zbozi;

final class ZboziImage
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    // Pomocná metoda pro JSON export
    public function toArray(): array
    {
        return [
            'url' => $this->url,
        ];
    }
}
