<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles;

use JsonSerializable;

/**
 * Text outline/stroke styling.
 *
 * @see https://developer.apple.com/documentation/apple_news/textstrokestyle
 */
final class TextStrokeStyle implements JsonSerializable
{
    /**
     * The stroke color.
     */
    private ?string $color = null;

    /**
     * The stroke width.
     */
    private ?int $width = null;

    /**
     * Set the stroke color.
     *
     * @param string $color The color in hex format.
     *
     * @return $this
     */
    public function setColor(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Set the stroke width.
     *
     * @param int $width The width in points.
     *
     * @return $this
     */
    public function setWidth(int $width): self
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Create a text stroke.
     *
     * @param string $color The stroke color.
     * @param int    $width The stroke width.
     *
     * @return self A new instance.
     */
    public static function create(string $color, int $width = 1): self
    {
        return (new self())
            ->setColor($color)
            ->setWidth($width);
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->color !== null) {
            $data['color'] = $this->color;
        }

        if ($this->width !== null) {
            $data['width'] = $this->width;
        }

        return $data;
    }
}

