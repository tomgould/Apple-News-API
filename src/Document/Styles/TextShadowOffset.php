<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles;

use JsonSerializable;

/**
 * Offset positioning for text shadows.
 *
 * @see https://developer.apple.com/documentation/apple_news/textshadowoffset
 */
final class TextShadowOffset implements JsonSerializable
{
    /**
     * Create a new TextShadowOffset.
     *
     * @param float $x The horizontal offset in points.
     * @param float $y The vertical offset in points.
     */
    public function __construct(
        private readonly float $x = 0,
        private readonly float $y = 0
    ) {
    }

    /**
     * Create a new offset.
     *
     * @param float $x The horizontal offset.
     * @param float $y The vertical offset.
     *
     * @return self A new instance.
     */
    public static function create(float $x, float $y): self
    {
        return new self($x, $y);
    }

    /**
     * {@inheritdoc}
     *
     * @return array{x: float, y: float}
     */
    public function jsonSerialize(): array
    {
        return [
            'x' => $this->x,
            'y' => $this->y,
        ];
    }
}

