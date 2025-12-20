<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Pullquote component for highlighting quotes.
 *
 * @see https://developer.apple.com/documentation/apple_news/pullquote
 */
final class Pullquote extends TextComponent
{
    public function getRole(): string
    {
        return 'pullquote';
    }
}
