<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Layouts;

use JsonSerializable;

/**
 * Defines the column system for an article.
 *
 * @see https://developer.apple.com/documentation/apple_news/layout
 */
final class Layout implements JsonSerializable
{
    private ?int $margin = null;
    private ?int $gutter = null;

    public function __construct(
        private readonly int $columns,
        private readonly int $width
    ) {
    }

    /**
     * Set the margin (space outside the content area).
     */
    public function setMargin(int $margin): self
    {
        $this->margin = $margin;
        return $this;
    }

    /**
     * Set the gutter (space between columns).
     */
    public function setGutter(int $gutter): self
    {
        $this->gutter = $gutter;
        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [
            'columns' => $this->columns,
            'width' => $this->width,
        ];

        if ($this->margin !== null) {
            $data['margin'] = $this->margin;
        }

        if ($this->gutter !== null) {
            $data['gutter'] = $this->gutter;
        }

        return $data;
    }
}
