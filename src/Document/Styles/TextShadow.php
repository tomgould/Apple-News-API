<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles;

use JsonSerializable;

/**
 * Shadow effect for text.
 *
 * @see https://developer.apple.com/documentation/apple_news/textshadow
 */
final class TextShadow implements JsonSerializable
{
    /**
     * The shadow color.
     */
    private ?string $color = null;

    /**
     * The blur radius.
     */
    private ?int $radius = null;

    /**
     * The shadow offset.
     */
    private ?TextShadowOffset $offset = null;

    /**
     * Set the shadow color.
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
     * Set the blur radius.
     *
     * @param int $radius The radius in points.
     *
     * @return $this
     */
    public function setRadius(int $radius): self
    {
        $this->radius = $radius;
        return $this;
    }

    /**
     * Set the shadow offset.
     *
     * @param TextShadowOffset $offset The offset configuration.
     *
     * @return $this
     */
    public function setOffset(TextShadowOffset $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * Set the shadow offset using x/y values.
     *
     * @param float $x The horizontal offset.
     * @param float $y The vertical offset.
     *
     * @return $this
     */
    public function setOffsetXY(float $x, float $y): self
    {
        $this->offset = TextShadowOffset::create($x, $y);
        return $this;
    }

    /**
     * Create a simple drop shadow.
     *
     * @param string $color  The shadow color.
     * @param int    $radius The blur radius.
     * @param float  $x      The horizontal offset.
     * @param float  $y      The vertical offset.
     *
     * @return self A new instance.
     */
    public static function dropShadow(
        string $color = '#00000066',
        int $radius = 2,
        float $x = 1,
        float $y = 1
    ): self {
        return (new self())
            ->setColor($color)
            ->setRadius($radius)
            ->setOffsetXY($x, $y);
    }

    /**
     * Create a subtle shadow.
     *
     * @return self A new instance.
     */
    public static function subtle(): self
    {
        return self::dropShadow('#00000033', 1, 0, 1);
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

        if ($this->radius !== null) {
            $data['radius'] = $this->radius;
        }

        if ($this->offset !== null) {
            $data['offset'] = $this->offset->jsonSerialize();
        }

        return $data;
    }
}

