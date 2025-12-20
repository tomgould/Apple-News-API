<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Video component for displaying video content.
 *
 * @see https://developer.apple.com/documentation/apple_news/video-component
 */
final class Video extends Component
{
    private ?string $caption = null;
    private ?string $stillURL = null;
    private ?string $accessibilityCaption = null;
    private ?bool $explicitContent = null;

    public function __construct(
        private readonly string $url
    ) {
    }

    public function getRole(): string
    {
        return 'video';
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
     * Set the still image URL (thumbnail).
     */
    public function setStillURL(string $stillURL): self
    {
        $this->stillURL = $stillURL;
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

        if ($this->stillURL !== null) {
            $data['stillURL'] = $this->stillURL;
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
