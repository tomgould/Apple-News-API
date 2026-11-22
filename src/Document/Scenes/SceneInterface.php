<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Scenes;

use JsonSerializable;

/**
 * Interface for all ANF scene types.
 *
 * Scenes combine animations and behaviors in the header of a section or chapter.
 * They create immersive visual effects as users scroll through the article.
 *
 * @see https://developer.apple.com/documentation/apple_news/scene
 */
interface SceneInterface extends JsonSerializable
{
    /**
     * Get the scene type identifier.
     *
     * @return string The scene type (e.g., 'fading_sticky_header', 'parallax_scale').
     */
    public function getType(): string;
}

