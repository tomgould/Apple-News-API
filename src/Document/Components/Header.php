<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Header container component.
 *
 * The header component defines the top area of an article, section, or chapter.
 * It typically contains the title, subtitle, and hero imagery.
 *
 * @see https://developer.apple.com/documentation/apple_news/header
 */
class Header extends Container
{
    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'header';
    }
}

