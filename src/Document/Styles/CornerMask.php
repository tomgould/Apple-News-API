<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles;

use JsonSerializable;

/**
 * Rounded corner clipping for components.
 *
 * @see https://developer.apple.com/documentation/apple_news/cornermask
 */
final class CornerMask implements JsonSerializable
{
    /**
     * Valid mask types.
     */
    public const TYPE_CORNERS = 'corners';

    /**
     * The mask type.
     */
    private string $type = self::TYPE_CORNERS;

    /**
     * The corner radius.
     */
    private ?int $radius = null;

    /**
     * Whether to mask top-left corner.
     */
    private ?bool $topLeft = null;

    /**
     * Whether to mask top-right corner.
     */
    private ?bool $topRight = null;

    /**
     * Whether to mask bottom-left corner.
     */
    private ?bool $bottomLeft = null;

    /**
     * Whether to mask bottom-right corner.
     */
    private ?bool $bottomRight = null;

    /**
     * Set the corner radius.
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
     * Set which corners to mask.
     *
     * @param bool $topLeft     Whether to round top-left.
     * @param bool $topRight    Whether to round top-right.
     * @param bool $bottomLeft  Whether to round bottom-left.
     * @param bool $bottomRight Whether to round bottom-right.
     *
     * @return $this
     */
    public function setCorners(
        bool $topLeft = true,
        bool $topRight = true,
        bool $bottomLeft = true,
        bool $bottomRight = true
    ): self {
        $this->topLeft = $topLeft;
        $this->topRight = $topRight;
        $this->bottomLeft = $bottomLeft;
        $this->bottomRight = $bottomRight;
        return $this;
    }

    /**
     * Create a uniform corner mask.
     *
     * @param int $radius The corner radius.
     *
     * @return self A new instance.
     */
    public static function uniform(int $radius): self
    {
        return (new self())->setRadius($radius);
    }

    /**
     * Create a top corners only mask.
     *
     * @param int $radius The corner radius.
     *
     * @return self A new instance.
     */
    public static function topOnly(int $radius): self
    {
        return (new self())
            ->setRadius($radius)
            ->setCorners(true, true, false, false);
    }

    /**
     * Create a bottom corners only mask.
     *
     * @param int $radius The corner radius.
     *
     * @return self A new instance.
     */
    public static function bottomOnly(int $radius): self
    {
        return (new self())
            ->setRadius($radius)
            ->setCorners(false, false, true, true);
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [
            'type' => $this->type,
        ];

        if ($this->radius !== null) {
            $data['radius'] = $this->radius;
        }

        if ($this->topLeft !== null) {
            $data['topLeft'] = $this->topLeft;
        }

        if ($this->topRight !== null) {
            $data['topRight'] = $this->topRight;
        }

        if ($this->bottomLeft !== null) {
            $data['bottomLeft'] = $this->bottomLeft;
        }

        if ($this->bottomRight !== null) {
            $data['bottomRight'] = $this->bottomRight;
        }

        return $data;
    }
}
