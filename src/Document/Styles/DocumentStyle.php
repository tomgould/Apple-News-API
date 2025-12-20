<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Styles;

use JsonSerializable;

/**
 * Document-level styles for Apple News Format.
 *
 * @see https://developer.apple.com/documentation/apple_news/documentstyle
 */
final class DocumentStyle implements JsonSerializable
{
    private ?string $backgroundColor = null;

    /**
     * Set the background color.
     */
    public function setBackgroundColor(string $color): self
    {
        $this->backgroundColor = $color;
        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->backgroundColor !== null) {
            $data['backgroundColor'] = $this->backgroundColor;
        }

        return $data;
    }
}
