<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Components;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Components\Map;
use TomGould\AppleNews\Document\Components\Place;

final class LocationComponentsTest extends TestCase
{
    public function testMapComponent(): void
    {
        $map = new Map(37.7749, -122.4194);

        $data = $map->jsonSerialize();

        $this->assertSame('map', $data['role']);
        $this->assertSame(37.7749, $data['latitude']);
        $this->assertSame(-122.4194, $data['longitude']);
    }

    public function testMapAtCoordinates(): void
    {
        $map = Map::atCoordinates(51.5074, -0.1278);

        $data = $map->jsonSerialize();

        $this->assertSame('map', $data['role']);
        $this->assertSame(51.5074, $data['latitude']);
        $this->assertSame(-0.1278, $data['longitude']);
    }

    public function testMapWithOptions(): void
    {
        $map = (new Map(40.7128, -74.0060))
            ->setMapType('satellite')
            ->setCaption('New York City')
            ->setAccessibilityCaption('Map of New York City')
            ->setSpan(0.1, 0.1);

        $data = $map->jsonSerialize();

        $this->assertSame('satellite', $data['mapType']);
        $this->assertSame('New York City', $data['caption']);
        $this->assertSame('Map of New York City', $data['accessibilityCaption']);
        $this->assertSame(['latitudeDelta' => 0.1, 'longitudeDelta' => 0.1], $data['span']);
    }

    public function testMapWithMarkers(): void
    {
        $map = (new Map(37.7749, -122.4194))
            ->addMarker(37.7749, -122.4194, 'San Francisco')
            ->addMarker(37.3382, -121.8863, 'San Jose')
            ->addMarker(37.5485, -122.0590);

        $data = $map->jsonSerialize();

        $this->assertCount(3, $data['items']);
        $this->assertSame('San Francisco', $data['items'][0]['caption']);
        $this->assertSame('San Jose', $data['items'][1]['caption']);
        $this->assertArrayNotHasKey('caption', $data['items'][2]);
    }

    public function testPlaceComponent(): void
    {
        $place = new Place(48.8566, 2.3522);

        $data = $place->jsonSerialize();

        $this->assertSame('place', $data['role']);
        $this->assertSame(48.8566, $data['latitude']);
        $this->assertSame(2.3522, $data['longitude']);
    }

    public function testPlaceAtCoordinates(): void
    {
        $place = Place::atCoordinates(35.6762, 139.6503);

        $data = $place->jsonSerialize();

        $this->assertSame('place', $data['role']);
        $this->assertSame(35.6762, $data['latitude']);
    }

    public function testPlaceWithOptions(): void
    {
        $place = (new Place(48.8566, 2.3522))
            ->setMapType('hybrid')
            ->setCaption('Paris, France')
            ->setAccessibilityCaption('Map showing Paris')
            ->setSpan(0.05, 0.05);

        $data = $place->jsonSerialize();

        $this->assertSame('hybrid', $data['mapType']);
        $this->assertSame('Paris, France', $data['caption']);
        $this->assertSame(['latitudeDelta' => 0.05, 'longitudeDelta' => 0.05], $data['span']);
    }
}

