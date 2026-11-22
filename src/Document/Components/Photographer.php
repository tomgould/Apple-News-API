<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Photographer credit component.
 *
 * The photographer component displays credit for article photographs.
 *
 * @see https://developer.apple.com/documentation/apple_news/photographer
 */
final class Photographer extends TextComponent
{
    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'photographer';
    }
}

