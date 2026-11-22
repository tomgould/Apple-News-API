<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Additions;

use JsonSerializable;

/**
 * Interface for all addition types.
 *
 * Additions make components or text ranges interactive.
 *
 * @see https://developer.apple.com/documentation/apple_news/addition
 */
interface AdditionInterface extends JsonSerializable
{
    /**
     * Get the addition type identifier.
     *
     * @return string The addition type.
     */
    public function getType(): string;
}

