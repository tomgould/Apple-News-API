<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles\Fills;

/**
 * Image background fill.
 *
 * @see https://developer.apple.com/documentation/apple_news/imagefill
 */
final class ImageFill implements FillInterface
{
    /**
     * Valid fill modes.
     */
    public const FILL_COVER = 'cover';
    public const FILL_FIT = 'fit';

    /**
     * Valid vertical alignments.
     */
    public const ALIGN_TOP = 'top';
    public const ALIGN_CENTER = 'center';
    public const ALIGN_BOTTOM = 'bottom';

    /**
     * Valid horizontal alignments.
     */
    public const ALIGN_LEFT = 'left';
    public const ALIGN_RIGHT = 'right';

    /**
     * The fill mode.
     */
    private ?string $fillMode = null;

    /**
     * The vertical alignment.
     */
    private ?string $verticalAlignment = null;

    /**
     * The horizontal alignment.
     */
    private ?string $horizontalAlignment = null;

    /**
     * Create a new ImageFill.
     *
     * @param string $url The image URL.
     */
    public function __construct(
        private readonly string $url
    ) {
    }

    /**
     * Create an ImageFill from a URL.
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
     * Create an ImageFill from a bundle file.
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
        return 'image';
    }

    /**
     * Set the fill mode.
     *
     * @param string $mode One of 'cover', 'fit'.
     *
     * @return $this
     */
    public function setFillMode(string $mode): self
    {
        $this->fillMode = $mode;
        return $this;
    }

    /**
     * Set the vertical alignment.
     *
     * @param string $alignment One of 'top', 'center', 'bottom'.
     *
     * @return $this
     */
    public function setVerticalAlignment(string $alignment): self
    {
        $this->verticalAlignment = $alignment;
        return $this;
    }

    /**
     * Set the horizontal alignment.
     *
     * @param string $alignment One of 'left', 'center', 'right'.
     *
     * @return $this
     */
    public function setHorizontalAlignment(string $alignment): self
    {
        $this->horizontalAlignment = $alignment;
        return $this;
    }

    /**
     * Set to cover mode.
     *
     * @return $this
     */
    public function asCover(): self
    {
        $this->fillMode = self::FILL_COVER;
        return $this;
    }

    /**
     * Set to fit mode.
     *
     * @return $this
     */
    public function asFit(): self
    {
        $this->fillMode = self::FILL_FIT;
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

        if ($this->fillMode !== null) {
            $data['fillMode'] = $this->fillMode;
        }

        if ($this->verticalAlignment !== null) {
            $data['verticalAlignment'] = $this->verticalAlignment;
        }

        if ($this->horizontalAlignment !== null) {
            $data['horizontalAlignment'] = $this->horizontalAlignment;
        }

        return $data;
    }
}

