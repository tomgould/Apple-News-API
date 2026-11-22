<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Document\Components;

/**
 * Map component for displaying Apple Maps.
 *
 * The map component displays an interactive map with optional annotations.
 *
 * @see https://developer.apple.com/documentation/apple_news/map
 */
final class Map extends Component
{
    /**
     * The map type.
     */
    private ?string $mapType = null;

    /**
     * The caption for the map.
     */
    private ?string $caption = null;

    /**
     * The accessibility caption for VoiceOver users.
     */
    private ?string $accessibilityCaption = null;

    /**
     * Map annotation items.
     *
     * @var list<array<string, mixed>>|null
     */
    private ?array $items = null;

    /**
     * Map span configuration.
     *
     * @var array{latitudeDelta?: float, longitudeDelta?: float}|null
     */
    private ?array $span = null;

    /**
     * Create a new Map component.
     *
     * @param float $latitude  The center latitude.
     * @param float $longitude The center longitude.
     */
    public function __construct(
        private readonly float $latitude,
        private readonly float $longitude
    ) {
    }

    /**
     * Create a Map centered at specific coordinates.
     *
     * @param float $latitude  The center latitude.
     * @param float $longitude The center longitude.
     *
     * @return self A new Map instance.
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
        return 'map';
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
     * Set the map caption.
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
     * Add a marker annotation to the map.
     *
     * @param float       $latitude  The marker latitude.
     * @param float       $longitude The marker longitude.
     * @param string|null $caption   Optional marker caption.
     *
     * @return $this
     */
    public function addMarker(float $latitude, float $longitude, ?string $caption = null): self
    {
        if ($this->items === null) {
            $this->items = [];
        }

        $item = [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];

        if ($caption !== null) {
            $item['caption'] = $caption;
        }

        $this->items[] = $item;
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

        if ($this->items !== null) {
            $data['items'] = $this->items;
        }

        return $data;
    }
}

