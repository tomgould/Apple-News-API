<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Components;

use TomGould\AppleNews\Document\Components\Gallery;
use PHPUnit\Framework\TestCase;

/**
 * Additional Gallery tests for edge cases.
 */
final class GalleryFullTest extends TestCase
{
    public function testGalleryWithBaseProperties(): void
    {
        $gallery = (new Gallery())
            ->setIdentifier('photo-gallery')
            ->setLayout('galleryLayout')
            ->setStyle('galleryStyle')
            ->addItem('https://example.com/image1.jpg')
            ->addItem('https://example.com/image2.jpg');

        $data = $gallery->jsonSerialize();

        $this->assertEquals('gallery', $data['role']);
        $this->assertEquals('photo-gallery', $data['identifier']);
        $this->assertEquals('galleryLayout', $data['layout']);
        $this->assertEquals('galleryStyle', $data['style']);
        $this->assertCount(2, $data['items']);
    }

    public function testGalleryItemWithOnlyCaption(): void
    {
        $gallery = (new Gallery())
            ->addItem('https://example.com/image.jpg', 'A caption', null);

        $data = $gallery->jsonSerialize();

        $this->assertEquals('A caption', $data['items'][0]['caption']);
        $this->assertArrayNotHasKey('accessibilityCaption', $data['items'][0]);
    }

    public function testGalleryItemWithOnlyAccessibilityCaption(): void
    {
        $gallery = (new Gallery())
            ->addItem('https://example.com/image.jpg', null, 'Screen reader text');

        $data = $gallery->jsonSerialize();

        $this->assertArrayNotHasKey('caption', $data['items'][0]);
        $this->assertEquals('Screen reader text', $data['items'][0]['accessibilityCaption']);
    }
}

