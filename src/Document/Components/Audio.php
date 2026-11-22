<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Audio component for audio content playback.
 *
 * The audio component embeds an audio player for podcast episodes,
 * music clips, or other audio content.
 *
 * @see https://developer.apple.com/documentation/apple_news/audio
 */
final class Audio extends Component
{
    /**
     * The caption for the audio.
     */
    private ?string $caption = null;

    /**
     * The accessibility caption for VoiceOver users.
     */
    private ?string $accessibilityCaption = null;

    /**
     * URL to an image to display while audio is loading or paused.
     */
    private ?string $imageURL = null;

    /**
     * Whether the audio contains explicit content.
     */
    private ?bool $explicitContent = null;

    /**
     * Create a new Audio component.
     *
     * @param string $url The URL to the audio file (MP3, AAC, etc.).
     */
    public function __construct(
        private readonly string $url
    ) {
    }

    /**
     * Create an Audio from a URL.
     *
     * @param string $url The audio file URL.
     *
     * @return self A new Audio instance.
     */
    public static function fromUrl(string $url): self
    {
        return new self($url);
    }

    /**
     * Create an Audio from a bundle file reference.
     *
     * @param string $filename The filename in the article bundle.
     *
     * @return self A new Audio instance.
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
        return 'audio';
    }

    /**
     * Set the audio caption.
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
     * Set the image URL to display while audio loads or is paused.
     *
     * @param string $imageURL The image URL.
     *
     * @return $this
     */
    public function setImageURL(string $imageURL): self
    {
        $this->imageURL = $imageURL;
        return $this;
    }

    /**
     * Set whether the audio contains explicit content.
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

        if ($this->imageURL !== null) {
            $data['imageURL'] = $this->imageURL;
        }

        if ($this->explicitContent !== null) {
            $data['explicitContent'] = $this->explicitContent;
        }

        return $data;
    }
}

