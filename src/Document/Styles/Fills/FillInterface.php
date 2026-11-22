<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles\Fills;

use JsonSerializable;

/**
 * Interface for all fill types.
 *
 * Fills define background content for components.
 *
 * @see https://developer.apple.com/documentation/apple_news/fill
 */
interface FillInterface extends JsonSerializable
{
    /**
     * Get the fill type identifier.
     *
     * @return string The fill type.
     */
    public function getType(): string;
}

