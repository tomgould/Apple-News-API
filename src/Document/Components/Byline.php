<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Byline component for publication date and contributor credits.
 *
 * The byline component is typically used to display publication information
 * such as the date, author names, and other credits in a single line.
 *
 * @see https://developer.apple.com/documentation/apple_news/byline
 */
final class Byline extends TextComponent
{
    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'byline';
    }
}

