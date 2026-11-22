<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Components;

use TomGould\AppleNews\Document\Components\Photo;
use PHPUnit\Framework\TestCase;

/**
 * Additional Photo tests for edge cases.
 */
final class PhotoFullTest extends TestCase
{
    public function testPhotoExplicitContentFalse(): void
    {
        $photo = Photo::fromUrl('https://example.com/image.jpg')
            ->setExplicitContent(false);

        $data = $photo->jsonSerialize();

        $this->assertFalse($data['explicitContent']);
    }

    public function testPhotoWithAllProperties(): void
    {
        $photo = Photo::fromUrl('https://example.com/image.jpg')
            ->setIdentifier('hero-photo')
            ->setLayout('photoLayout')
            ->setStyle('photoStyle')
            ->setCaption('A beautiful photo')
            ->setAccessibilityCaption('Description for screen readers')
            ->setExplicitContent(true)
            ->setAnimation(['type' => 'fade_in'])
            ->setBehavior(['type' => 'parallax', 'factor' => 0.5]);

        $data = $photo->jsonSerialize();

        $this->assertEquals('photo', $data['role']);
        $this->assertEquals('hero-photo', $data['identifier']);
        $this->assertEquals('photoLayout', $data['layout']);
        $this->assertEquals('photoStyle', $data['style']);
        $this->assertEquals('https://example.com/image.jpg', $data['URL']);
        $this->assertEquals('A beautiful photo', $data['caption']);
        $this->assertEquals('Description for screen readers', $data['accessibilityCaption']);
        $this->assertTrue($data['explicitContent']);
        $this->assertEquals('fade_in', $data['animation']['type']);
        $this->assertEquals('parallax', $data['behavior']['type']);
    }
}

