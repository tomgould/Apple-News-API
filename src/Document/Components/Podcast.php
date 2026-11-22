<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Podcast component for Apple Podcasts integration.
 *
 * The podcast component embeds a podcast episode player, allowing users
 * to listen to podcast content directly within the article.
 *
 * @see https://developer.apple.com/documentation/apple_news/podcast_component
 */
final class Podcast extends Component
{
    /**
     * The caption for the podcast.
     */
    private ?string $caption = null;

    /**
     * The accessibility caption for VoiceOver users.
     */
    private ?string $accessibilityCaption = null;

    /**
     * URL to an image to display while podcast is loading.
     */
    private ?string $imageURL = null;

    /**
     * Whether the podcast contains explicit content.
     */
    private ?bool $explicitContent = null;

    /**
     * Create a new Podcast component.
     *
     * @param string $url The Apple Podcasts URL.
     */
    public function __construct(
        private readonly string $url
    ) {
    }

    /**
     * Create a Podcast component from an Apple Podcasts URL.
     *
     * @param string $url The Apple Podcasts URL.
     *
     * @return self A new Podcast instance.
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
        return 'podcast';
    }

    /**
     * Set the podcast caption.
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
     * Set the image URL to display while podcast loads.
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
     * Set whether the podcast contains explicit content.
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

