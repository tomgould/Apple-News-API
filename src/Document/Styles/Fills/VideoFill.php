<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles\Fills;

/**
 * Video background fill.
 *
 * @see https://developer.apple.com/documentation/apple_news/videofill
 */
final class VideoFill implements FillInterface
{
    /**
     * Valid fill modes.
     */
    public const FILL_COVER = 'cover';
    public const FILL_FIT = 'fit';

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
     * Whether to loop the video.
     */
    private ?bool $loop = null;

    /**
     * The still image URL to show while loading.
     */
    private ?string $stillURL = null;

    /**
     * Create a new VideoFill.
     *
     * @param string $url The video URL.
     */
    public function __construct(
        private readonly string $url
    ) {
    }

    /**
     * Create a VideoFill from a URL.
     *
     * @param string $url The video URL.
     *
     * @return self A new instance.
     */
    public static function fromUrl(string $url): self
    {
        return new self($url);
    }

    /**
     * Create a VideoFill from a bundle file.
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
        return 'video';
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
     * Set whether to loop the video.
     *
     * @param bool $loop Whether to loop.
     *
     * @return $this
     */
    public function setLoop(bool $loop): self
    {
        $this->loop = $loop;
        return $this;
    }

    /**
     * Set the still image URL.
     *
     * @param string $url The still image URL.
     *
     * @return $this
     */
    public function setStillURL(string $url): self
    {
        $this->stillURL = $url;
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

        if ($this->loop !== null) {
            $data['loop'] = $this->loop;
        }

        if ($this->stillURL !== null) {
            $data['stillURL'] = $this->stillURL;
        }

        return $data;
    }
}

