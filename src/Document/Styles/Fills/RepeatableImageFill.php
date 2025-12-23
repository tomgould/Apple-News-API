<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles\Fills;

/**
 * Tiled/repeatable image background fill.
 *
 * @see https://developer.apple.com/documentation/apple_news/repeatableimagefill
 */
final class RepeatableImageFill implements FillInterface
{
    /**
     * Valid repeat modes.
     */
    public const REPEAT_BOTH = 'both';
    public const REPEAT_X = 'x';
    public const REPEAT_Y = 'y';
    public const REPEAT_NONE = 'none';

    /**
     * The repeat mode.
     */
    private ?string $repeat = null;

    /**
     * The width of each tile.
     */
    private ?int $width = null;

    /**
     * The height of each tile.
     */
    private ?int $height = null;

    /**
     * Create a new RepeatableImageFill.
     *
     * @param string $url The image URL.
     */
    public function __construct(
        private readonly string $url
    ) {
    }

    /**
     * Create a RepeatableImageFill from a URL.
     *
     * @param string $url The image URL.
     *
     * @return self A new instance.
     */
    public static function fromUrl(string $url): self
    {
        return new self($url);
    }

    /**
     * Create a RepeatableImageFill from a bundle file.
     *
     * @param string $filename The filename in the bundle.
     *
     * @return self A new instance.
     */
    public static function fromBundle(string $filename): self
    {
        return new self('bundle://' . $filename);
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return 'repeatable_image';
    }

    /**
     * Set the repeat mode.
     *
     * @param string $repeat One of 'both', 'x', 'y', 'none'.
     *
     * @return $this
     */
    public function setRepeat(string $repeat): self
    {
        $this->repeat = $repeat;
        return $this;
    }

    /**
     * Set to repeat in both directions.
     *
     * @return $this
     */
    public function repeatBoth(): self
    {
        $this->repeat = self::REPEAT_BOTH;
        return $this;
    }

    /**
     * Set to repeat horizontally only.
     *
     * @return $this
     */
    public function repeatX(): self
    {
        $this->repeat = self::REPEAT_X;
        return $this;
    }

    /**
     * Set to repeat vertically only.
     *
     * @return $this
     */
    public function repeatY(): self
    {
        $this->repeat = self::REPEAT_Y;
        return $this;
    }

    /**
     * Set the tile width.
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
     * Set the tile height.
     *
     * @param int $height The height in points.
     *
     * @return $this
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Set the tile size.
     *
     * @param int $width  The width in points.
     * @param int $height The height in points.
     *
     * @return $this
     */
    public function setSize(int $width, int $height): self
    {
        $this->width = $width;
        $this->height = $height;
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [
            'type' => $this->getType(),
            'URL' => $this->url,
        ];

        if ($this->repeat !== null) {
            $data['repeat'] = $this->repeat;
        }

        if ($this->width !== null) {
            $data['width'] = $this->width;
        }

        if ($this->height !== null) {
            $data['height'] = $this->height;
        }

        return $data;
    }
}
