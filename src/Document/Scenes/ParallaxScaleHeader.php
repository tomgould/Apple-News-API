<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Scenes;

/**
 * Parallax scale header scene.
 *
 * The parallax_scale scene creates a zoom-out parallax effect on the header
 * as the user scrolls. The header image scales down while remaining visible,
 * creating a dramatic reveal effect.
 *
 * @see https://developer.apple.com/documentation/apple_news/parallaxscaleheader
 */
final class ParallaxScaleHeader implements SceneInterface
{
    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return 'parallax_scale';
    }

    /**
     * {@inheritdoc}
     *
     * @return array{type: string}
     */
    public function jsonSerialize(): array
    {
        return [
            'type' => $this->getType(),
        ];
    }
}

