<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Illustrator credit component.
 *
 * The illustrator component displays credit for article illustrations.
 *
 * @see https://developer.apple.com/documentation/apple_news/illustrator
 */
final class Illustrator extends TextComponent
{
    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'illustrator';
    }
}

