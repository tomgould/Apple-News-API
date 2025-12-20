<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * EmbedWebVideo component for embedding YouTube, Vimeo, etc.
 *
 * @see https://developer.apple.com/documentation/apple_news/embedwebvideo
 */
final class EmbedWebVideo extends Component
{
    private ?string $caption = null;
    private ?string $accessibilityCaption = null;
    private ?bool $explicitContent = null;
    private ?string $aspectRatio = null;

    public function __construct(
        private readonly string $url
    ) {
    }

    public function getRole(): string
    {
        return 'embedwebvideo';
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
     * Set the aspect ratio (e.g., "1.777" for 16:9).
     */
    public function setAspectRatio(string $aspectRatio): self
    {
        $this->aspectRatio = $aspectRatio;
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

        if ($this->aspectRatio !== null) {
            $data['aspectRatio'] = $this->aspectRatio;
        }

        return $data;
    }
}
