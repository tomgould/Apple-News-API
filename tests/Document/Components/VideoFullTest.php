<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Components;

use TomGould\AppleNews\Document\Components\Video;
use TomGould\AppleNews\Document\Components\EmbedWebVideo;
use PHPUnit\Framework\TestCase;

/**
 * Additional Video tests for edge cases.
 */
final class VideoFullTest extends TestCase
{
    public function testVideoExplicitContentFalse(): void
    {
        $video = (new Video('https://example.com/video.mp4'))
            ->setExplicitContent(false);

        $data = $video->jsonSerialize();

        $this->assertFalse($data['explicitContent']);
    }

    public function testVideoWithAllProperties(): void
    {
        $video = (new Video('https://example.com/video.mp4'))
            ->setIdentifier('main-video')
            ->setLayout('videoLayout')
            ->setCaption('Video caption')
            ->setStillURL('https://example.com/still.jpg')
            ->setAccessibilityCaption('Video description for screen readers')
            ->setExplicitContent(true);

        $data = $video->jsonSerialize();

        $this->assertEquals('video', $data['role']);
        $this->assertEquals('main-video', $data['identifier']);
        $this->assertEquals('videoLayout', $data['layout']);
        $this->assertEquals('https://example.com/video.mp4', $data['URL']);
        $this->assertEquals('Video caption', $data['caption']);
        $this->assertEquals('https://example.com/still.jpg', $data['stillURL']);
        $this->assertEquals('Video description for screen readers', $data['accessibilityCaption']);
        $this->assertTrue($data['explicitContent']);
    }

    public function testEmbedWebVideoExplicitContentFalse(): void
    {
        $video = (new EmbedWebVideo('https://youtube.com/watch?v=123'))
            ->setExplicitContent(false);

        $data = $video->jsonSerialize();

        $this->assertFalse($data['explicitContent']);
    }
}

