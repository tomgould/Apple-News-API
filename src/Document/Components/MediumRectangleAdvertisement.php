<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Medium rectangle advertisement component (MREC).
 *
 * The medium_rectangle_advertisement component reserves space for a
 * 300x250 MREC ad that Apple News will fill based on available inventory.
 *
 * @see https://developer.apple.com/documentation/apple_news/mediumrectangleadvertisement
 */
final class MediumRectangleAdvertisement extends Component
{
    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'medium_rectangle_advertisement';
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return array_merge(
            ['role' => $this->getRole()],
            $this->getBaseProperties()
        );
    }
}

