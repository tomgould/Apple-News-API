<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Generic image component.
 *
 * The image component displays a generic image. This is functionally
 * similar to the Photo component but uses the 'image' role.
 *
 * @see https://developer.apple.com/documentation/apple_news/image
 */
final class Image extends Component
{
    /**
     * The caption for the image.
     */
    private ?string $caption = null;

    /**
     * The accessibility caption for VoiceOver users.
     */
    private ?string $accessibilityCaption = null;

    /**
     * Whether the image contains explicit content.
     */
    private ?bool $explicitContent = null;

    /**
     * Create a new Image component.
     *
     * @param string $url The URL to the image file.
     */
    public function __construct(
        private readonly string $url
    ) {
    }

    /**
     * Create an Image from a URL.
     *
     * @param string $url The image URL.
     *
     * @return self A new Image instance.
     */
    public static function fromUrl(string $url): self
    {
        return new self($url);
    }

    /**
     * Create an Image from a bundle file reference.
     *
     * @param string $filename The filename in the article bundle.
     *
     * @return self A new Image instance.
     */
    public static function fromBundle(string $filename): self
    {
        return new self('bundle://' . $filename);
    }

    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'image';
    }

    /**
     * Set the image caption.
     *
     * @param string $caption The caption text.
     *
     * @return $this
     */
    public function setCaption(string $caption): self
    {
        $this->caption = $caption;
        return $this;
    }

    /**
     * Set the accessibility caption for VoiceOver.
     *
     * @param string $caption The accessibility caption.
     *
     * @return $this
     */
    public function setAccessibilityCaption(string $caption): self
    {
        $this->accessibilityCaption = $caption;
        return $this;
    }

    /**
     * Set whether the image contains explicit content.
     *
     * @param bool $explicit Whether the content is explicit.
     *
     * @return $this
     */
    public function setExplicitContent(bool $explicit): self
    {
        $this->explicitContent = $explicit;
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = array_merge(
            ['role' => $this->getRole()],
            $this->getBaseProperties(),
            ['URL' => $this->url]
        );

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

