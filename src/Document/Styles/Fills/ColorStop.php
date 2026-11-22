<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles\Fills;

use JsonSerializable;

/**
 * Color stop for gradient fills.
 *
 * @see https://developer.apple.com/documentation/apple_news/colorstop
 */
final class ColorStop implements JsonSerializable
{
    /**
     * Create a new ColorStop.
     *
     * @param string $color    The color in hex format.
     * @param float  $location The location (0.0 to 100.0 as percentage).
     */
    public function __construct(
        private readonly string $color,
        private readonly float $location
    ) {
    }

    /**
     * Create a color stop.
     *
     * @param string $color    The color.
     * @param float  $location The location percentage (0-100).
     *
     * @return self A new instance.
     */
    public static function at(string $color, float $location): self
    {
        return new self($color, $location);
    }

    /**
     * {@inheritdoc}
     *
     * @return array{color: string, location: float}
     */
    public function jsonSerialize(): array
    {
        return [
            'color' => $this->color,
            'location' => $this->location,
        ];
    }
}

