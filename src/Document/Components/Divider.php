<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Divider component for visual separation.
 *
 * @see https://developer.apple.com/documentation/apple_news/divider
 */
final class Divider extends Component
{
    private ?array $stroke = null;

    public function getRole(): string
    {
        return 'divider';
    }

    /**
     * Set the stroke style.
     *
     * @param array<string, mixed> $stroke
     */
    public function setStroke(array $stroke): self
    {
        $this->stroke = $stroke;
        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = $this->getBaseProperties();

        if ($this->stroke !== null) {
            $data['stroke'] = $this->stroke;
        }

        return $data;
    }
}
