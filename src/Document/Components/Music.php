<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Music component for Apple Music integration.
 *
 * The music component embeds an Apple Music player, allowing users to
 * listen to tracks directly within the article.
 *
 * @see https://developer.apple.com/documentation/apple_news/music
 */
final class Music extends Component
{
    /**
     * The caption for the music.
     */
    private ?string $caption = null;

    /**
     * The accessibility caption for VoiceOver users.
     */
    private ?string $accessibilityCaption = null;

    /**
     * URL to an image to display while music is loading.
     */
    private ?string $imageURL = null;

    /**
     * Whether the music contains explicit content.
     */
    private ?bool $explicitContent = null;

    /**
     * Create a new Music component.
     *
     * @param string $url The Apple Music URL.
     */
    public function __construct(
        private readonly string $url
    ) {
    }

    /**
     * Create a Music component from an Apple Music URL.
     *
     * @param string $url The Apple Music URL.
     *
     * @return self A new Music instance.
     */
    public static function fromUrl(string $url): self
    {
        return new self($url);
    }

    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'music';
    }

    /**
     * Set the music caption.
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
     * Set the image URL to display while music loads.
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
     * Set whether the music contains explicit content.
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

