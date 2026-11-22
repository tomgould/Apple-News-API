<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * ARKit component for augmented reality experiences.
 *
 * The arkit component embeds an AR experience using USDZ files.
 *
 * @see https://developer.apple.com/documentation/apple_news/arkit
 */
final class ARKit extends Component
{
    /**
     * The caption for the AR experience.
     */
    private ?string $caption = null;

    /**
     * The accessibility caption for VoiceOver users.
     */
    private ?string $accessibilityCaption = null;

    /**
     * Create a new ARKit component.
     *
     * @param string $url The URL to the USDZ file.
     */
    public function __construct(
        private readonly string $url
    ) {
    }

    /**
     * Create an ARKit from a URL.
     *
     * @param string $url The USDZ file URL.
     *
     * @return self A new ARKit instance.
     */
    public static function fromUrl(string $url): self
    {
        return new self($url);
    }

    /**
     * Create an ARKit from a bundle file reference.
     *
     * @param string $filename The filename in the article bundle.
     *
     * @return self A new ARKit instance.
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
        return 'arkit';
    }

    /**
     * Set the AR experience caption.
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

        return $data;
    }
}

