<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Photo component for displaying images.
 *
 * @see https://developer.apple.com/documentation/apple_news/photo
 */
final class Photo extends Component
{
    private ?string $caption = null;
    private ?string $accessibilityCaption = null;
    private ?bool $explicitContent = null;

    public function __construct(
        private readonly string $url
    ) {
    }

    /**
     * Create a photo from a bundle URL.
     */
    public static function fromBundle(string $filename): self
    {
        return new self('bundle://' . $filename);
    }

    /**
     * Create a photo from a remote URL.
     */
    public static function fromUrl(string $url): self
    {
        return new self($url);
    }

    public function getRole(): string
    {
        return 'photo';
    }

    /**
     * Set the caption.
     */
    public function setCaption(string $caption): self
    {
        $this->caption = $caption;
        return $this;
    }

    /**
     * Set the accessibility caption.
     */
    public function setAccessibilityCaption(string $caption): self
    {
        $this->accessibilityCaption = $caption;
        return $this;
    }

    /**
     * Mark as explicit content.
     */
    public function setExplicitContent(bool $explicit): self
    {
        $this->explicitContent = $explicit;
        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = $this->getBaseProperties();
        $data['URL'] = $this->url;

        if ($this->caption !== null) {
            $data['caption'] = $this->caption;
        }

        if ($this->accessibilityCaption !== null) {
            $data['accessibilityCaption'] = $this->accessibilityCaption;
        }

        if ($this->explicitContent !== null) {
            $data['explicitContent'] = $this->explicitContent;
        }

        return $data;
    }
}
