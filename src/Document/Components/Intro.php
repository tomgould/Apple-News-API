<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Introductory or deck text component.
 *
 * The intro component displays introductory text that appears after the title
 * and before the main body content. It's typically used for article summaries
 * or deck text.
 *
 * @see https://developer.apple.com/documentation/apple_news/intro
 */
final class Intro extends TextComponent
{
    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'intro';
    }
}

