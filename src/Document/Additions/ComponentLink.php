<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Additions;

/**
 * Component link for making entire components tappable.
 *
 * Unlike LinkAddition which targets text ranges, ComponentLink
 * makes the entire component interactive.
 *
 * @see https://developer.apple.com/documentation/apple_news/componentlink
 */
final class ComponentLink implements AdditionInterface
{
    /**
     * Create a new ComponentLink.
     *
     * @param string $url The link URL.
     */
    public function __construct(
        private readonly string $url
    ) {
    }

    /**
     * Create a component link with a URL.
     *
     * @param string $url The URL to link to.
     *
     * @return self A new instance.
     */
    public static function to(string $url): self
    {
        return new self($url);
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return 'link';
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'type' => $this->getType(),
            'URL' => $this->url,
        ];
    }
}

