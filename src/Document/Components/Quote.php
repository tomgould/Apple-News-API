<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Block quote component.
 *
 * The quote component displays a block quotation. This is different from
 * the Pullquote component, which is used for highlighting excerpts from
 * the article itself.
 *
 * @see https://developer.apple.com/documentation/apple_news/quote
 */
final class Quote extends TextComponent
{
    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'quote';
    }
}

