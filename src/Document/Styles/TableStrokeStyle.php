<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles;

use JsonSerializable;

/**
 * Stroke style for table borders and dividers.
 *
 * @see https://developer.apple.com/documentation/apple_news/tablestrokestyle
 */
final class TableStrokeStyle implements JsonSerializable
{
    /**
     * The stroke color.
     */
    private ?string $color = null;

    /**
     * The stroke style.
     */
    private ?string $style = null;

    /**
     * The stroke width in points.
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
     * Set the stroke style.
     *
     * @param string $style One of 'solid', 'dashed', 'dotted'.
     *
     * @return $this
     */
    public function setStyle(string $style): self
    {
        $this->style = $style;
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
     * Create a solid stroke.
     *
     * @param string $color The stroke color.
     * @param int    $width The stroke width.
     *
     * @return self A new instance.
     */
    public static function solid(string $color, int $width = 1): self
    {
        return (new self())
            ->setColor($color)
            ->setStyle('solid')
            ->setWidth($width);
    }

    /**
     * Create a dashed stroke.
     *
     * @param string $color The stroke color.
     * @param int    $width The stroke width.
     *
     * @return self A new instance.
     */
    public static function dashed(string $color, int $width = 1): self
    {
        return (new self())
            ->setColor($color)
            ->setStyle('dashed')
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

        if ($this->style !== null) {
            $data['style'] = $this->style;
        }

        if ($this->width !== null) {
            $data['width'] = $this->width;
        }

        return $data;
    }
}

