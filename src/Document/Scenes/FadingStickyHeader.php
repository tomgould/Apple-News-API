<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Scenes;

/**
 * Fading sticky header scene.
 *
 * The fading_sticky_header scene causes the header to stick to the top of
 * the screen as the user scrolls, then fade out when the section content
 * begins to scroll beneath it.
 *
 * @see https://developer.apple.com/documentation/apple_news/fadingstickyheader
 */
final class FadingStickyHeader implements SceneInterface
{
    /**
     * The color to fade to (typically matches the section background).
     */
    private ?string $fadeColor = null;

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return 'fading_sticky_header';
    }

    /**
     * Set the fade color.
     *
     * This is the color the header fades to as the user scrolls.
     * Typically matches the section's background color.
     *
     * @param string $color The color in hex format (e.g., '#000000').
     *
     * @return $this
     */
    public function setFadeColor(string $color): self
    {
        $this->fadeColor = $color;
        return $this;
    }

    /**
     * Create a FadingStickyHeader with a specific fade color.
     *
     * @param string $color The fade color in hex format.
     *
     * @return self A new FadingStickyHeader instance.
     */
    public static function withFadeColor(string $color): self
    {
        return (new self())->setFadeColor($color);
    }

    /**
     * Create a FadingStickyHeader that fades to black.
     *
     * @return self A new FadingStickyHeader instance.
     */
    public static function fadeToBlack(): self
    {
        return (new self())->setFadeColor('#000000');
    }

    /**
     * Create a FadingStickyHeader that fades to white.
     *
     * @return self A new FadingStickyHeader instance.
     */
    public static function fadeToWhite(): self
    {
        return (new self())->setFadeColor('#FFFFFF');
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
        ];

        if ($this->fadeColor !== null) {
            $data['fadeColor'] = $this->fadeColor;
        }

        return $data;
    }
}

