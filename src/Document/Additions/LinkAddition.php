<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Additions;

/**
 * Link addition for making text ranges tappable.
 *
 * Used within text components to create hyperlinks on specific
 * ranges of text.
 *
 * @see https://developer.apple.com/documentation/apple_news/link
 */
final class LinkAddition implements AdditionInterface
{
    /**
     * The start position of the link range.
     */
    private ?int $rangeStart = null;

    /**
     * The length of the link range.
     */
    private ?int $rangeLength = null;

    /**
     * Create a new LinkAddition.
     *
     * @param string $url The link URL.
     */
    public function __construct(
        private readonly string $url
    ) {
    }

    /**
     * Create a link addition with a URL.
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
     * Set the text range for this link.
     *
     * @param int $start  The starting character position.
     * @param int $length The number of characters.
     *
     * @return $this
     */
    public function setRange(int $start, int $length): self
    {
        $this->rangeStart = $start;
        $this->rangeLength = $length;
        return $this;
    }

    /**
     * Create a link for a specific text range.
     *
     * @param string $url    The URL to link to.
     * @param int    $start  The starting character position.
     * @param int    $length The number of characters.
     *
     * @return self A new instance.
     */
    public static function forRange(string $url, int $start, int $length): self
    {
        return (new self($url))->setRange($start, $length);
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [
            'type' => $this->getType(),
            'URL' => $this->url,
        ];

        if ($this->rangeStart !== null) {
            $data['rangeStart'] = $this->rangeStart;
        }

        if ($this->rangeLength !== null) {
            $data['rangeLength'] = $this->rangeLength;
        }

        return $data;
    }
}

