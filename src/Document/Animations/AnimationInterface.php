<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Animations;

use JsonSerializable;

/**
 * Interface for all ANF component animations.
 *
 * Animations control how components appear when they come into view
 * as the user scrolls through the article.
 *
 * @see https://developer.apple.com/documentation/apple_news/componentanimation
 */
interface AnimationInterface extends JsonSerializable
{
    /**
     * Get the animation type identifier.
     *
     * @return string The animation type (e.g., 'fade_in', 'move_in').
     */
    public function getType(): string;
}

