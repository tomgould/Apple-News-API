<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Author name component.
 *
 * The author component displays the name of the article's author.
 * Use this for prominent author attribution separate from the byline.
 *
 * @see https://developer.apple.com/documentation/apple_news/author
 */
final class Author extends TextComponent
{
    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'author';
    }
}

