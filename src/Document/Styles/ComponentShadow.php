<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles;

use JsonSerializable;

/**
 * Shadow effect for components.
 *
 * @see https://developer.apple.com/documentation/apple_news/componentshadow
 */
final class ComponentShadow implements JsonSerializable
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
     * The shadow opacity (0.0 to 1.0).
     */
    private ?float $opacity = null;

    /**
     * The horizontal offset.
     */
    private ?int $offsetX = null;

    /**
     * The vertical offset.
     */
    private ?int $offsetY = null;

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
     * Set the opacity.
     *
     * @param float $opacity Opacity from 0.0 to 1.0.
     *
     * @return $this
     */
    public function setOpacity(float $opacity): self
    {
        $this->opacity = max(0.0, min(1.0, $opacity));
        return $this;
    }

    /**
     * Set the offset.
     *
     * @param int $x The horizontal offset in points.
     * @param int $y The vertical offset in points.
     *
     * @return $this
     */
    public function setOffset(int $x, int $y): self
    {
        $this->offsetX = $x;
        $this->offsetY = $y;
        return $this;
    }

    /**
     * Create a subtle shadow.
     *
     * @return self A new instance.
     */
    public static function subtle(): self
    {
        return (new self())
            ->setColor('#000000')
            ->setRadius(4)
            ->setOpacity(0.1)
            ->setOffset(0, 2);
    }

    /**
     * Create a medium shadow.
     *
     * @return self A new instance.
     */
    public static function medium(): self
    {
        return (new self())
            ->setColor('#000000')
            ->setRadius(8)
            ->setOpacity(0.15)
            ->setOffset(0, 4);
    }

    /**
     * Create a strong shadow.
     *
     * @return self A new instance.
     */
    public static function strong(): self
    {
        return (new self())
            ->setColor('#000000')
            ->setRadius(16)
            ->setOpacity(0.2)
            ->setOffset(0, 8);
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

        if ($this->opacity !== null) {
            $data['opacity'] = $this->opacity;
        }

        if ($this->offsetX !== null) {
            $data['offset'] = [
                'x' => $this->offsetX,
                'y' => $this->offsetY ?? 0,
            ];
        }

        return $data;
    }
}

