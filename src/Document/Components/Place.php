<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Place component for displaying a specific location.
 *
 * The place component displays a map centered on a specific place
 * with information about that location.
 *
 * @see https://developer.apple.com/documentation/apple_news/place
 */
final class Place extends Component
{
    /**
     * The map type.
     */
    private ?string $mapType = null;

    /**
     * The caption for the place.
     */
    private ?string $caption = null;

    /**
     * The accessibility caption for VoiceOver users.
     */
    private ?string $accessibilityCaption = null;

    /**
     * Map span configuration.
     *
     * @var array{latitudeDelta?: float, longitudeDelta?: float}|null
     */
    private ?array $span = null;

    /**
     * Create a new Place component.
     *
     * @param float $latitude  The place latitude.
     * @param float $longitude The place longitude.
     */
    public function __construct(
        private readonly float $latitude,
        private readonly float $longitude
    ) {
    }

    /**
     * Create a Place at specific coordinates.
     *
     * @param float $latitude  The place latitude.
     * @param float $longitude The place longitude.
     *
     * @return self A new Place instance.
     */
    public static function atCoordinates(float $latitude, float $longitude): self
    {
        return new self($latitude, $longitude);
    }

    /**
     * {@inheritdoc}
     */
    public function getRole(): string
    {
        return 'place';
    }

    /**
     * Set the map type.
     *
     * @param string $mapType The map type ('standard', 'hybrid', 'satellite').
     *
     * @return $this
     */
    public function setMapType(string $mapType): self
    {
        $this->mapType = $mapType;
        return $this;
    }

    /**
     * Set the place caption.
     *
     * @param string $caption The caption text.
     *
     * @return $this
     */
    public function setCaption(string $caption): self
    {
        $this->caption = $caption;
        return $this;
    }

    /**
     * Set the accessibility caption for VoiceOver.
     *
     * @param string $caption The accessibility caption.
     *
     * @return $this
     */
    public function setAccessibilityCaption(string $caption): self
    {
        $this->accessibilityCaption = $caption;
        return $this;
    }

    /**
     * Set the map span (zoom level).
     *
     * @param float $latitudeDelta  The latitude span in degrees.
     * @param float $longitudeDelta The longitude span in degrees.
     *
     * @return $this
     */
    public function setSpan(float $latitudeDelta, float $longitudeDelta): self
    {
        $this->span = [
            'latitudeDelta' => $latitudeDelta,
            'longitudeDelta' => $longitudeDelta,
        ];
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = array_merge(
            ['role' => $this->getRole()],
            $this->getBaseProperties(),
            [
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ]
        );

        if ($this->mapType !== null) {
            $data['mapType'] = $this->mapType;
        }

        if ($this->caption !== null) {
            $data['caption'] = $this->caption;
        }

        if ($this->accessibilityCaption !== null) {
            $data['accessibilityCaption'] = $this->accessibilityCaption;
        }

        if ($this->span !== null) {
            $data['span'] = $this->span;
        }

        return $data;
    }
}

