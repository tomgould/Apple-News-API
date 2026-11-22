<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * TikTok component for embedding TikTok videos.
 *
 * The tiktok component embeds a TikTok video in the article.
 *
 * @see https://developer.apple.com/documentation/apple_news/tiktok
 */
final class TikTok extends Component
{
    /**
     * Create a new TikTok component.
     *
     * @param string $url The TikTok video URL.
     */
    public function __construct(
        private readonly string $url
    ) {
    }

    /**
     * Create a TikTok from a video URL.
     *
     * @param string $url The TikTok video URL.
     *
     * @return self A new TikTok instance.
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
        return 'tiktok';
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return array_merge(
            ['role' => $this->getRole()],
            $this->getBaseProperties(),
            ['URL' => $this->url]
        );
    }
}
