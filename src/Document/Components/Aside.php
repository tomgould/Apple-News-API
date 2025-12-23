<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Aside container component.
 *
 * The aside component contains content that is related to but separate from
 * the main article content, such as sidebars, additional context, or
 * related information.
 *
 * @see https://developer.apple.com/documentation/apple_news/aside
 */
class Aside extends Container
{
    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'aside';
    }
}

