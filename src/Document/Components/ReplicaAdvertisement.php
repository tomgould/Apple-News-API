<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Replica advertisement component.
 *
 * The replica_advertisement component displays a print replica ad
 * from your publication.
 *
 * @see https://developer.apple.com/documentation/apple_news/replicaadvertisement
 */
final class ReplicaAdvertisement extends Component
{
    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'replica_advertisement';
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

