<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Components;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Components\ArticleThumbnail;

/**
 * Tests for the ArticleThumbnail component.
 */
final class ArticleThumbnailTest extends TestCase
{
    public function testBasicConstruction(): void
    {
        $thumbnail = new ArticleThumbnail('https://example.com/image.jpg');
        $json = $thumbnail->jsonSerialize();

        $this->assertSame('article_thumbnail', $json['role']);
        $this->assertSame('https://example.com/image.jpg', $json['URL']);
    }

    public function testFromUrl(): void
    {
        $thumbnail = ArticleThumbnail::fromUrl('https://example.com/thumb.png');
        $json = $thumbnail->jsonSerialize();

        $this->assertSame('article_thumbnail', $json['role']);
        $this->assertSame('https://example.com/thumb.png', $json['URL']);
    }

    public function testFromBundle(): void
    {
        $thumbnail = ArticleThumbnail::fromBundle('feed-image.jpg');
        $json = $thumbnail->jsonSerialize();

        $this->assertSame('article_thumbnail', $json['role']);
        $this->assertSame('bundle://feed-image.jpg', $json['URL']);
    }

    public function testWithCaption(): void
    {
        $thumbnail = (new ArticleThumbnail('https://example.com/image.jpg'))
            ->setCaption('A descriptive caption');
        $json = $thumbnail->jsonSerialize();

        $this->assertSame('A descriptive caption', $json['caption']);
    }

    public function testWithAccessibilityCaption(): void
    {
        $thumbnail = (new ArticleThumbnail('https://example.com/image.jpg'))
            ->setAccessibilityCaption('Image shows a sunset over mountains');
        $json = $thumbnail->jsonSerialize();

        $this->assertSame('Image shows a sunset over mountains', $json['accessibilityCaption']);
    }

    public function testWithExplicitContent(): void
    {
        $thumbnail = (new ArticleThumbnail('https://example.com/image.jpg'))
            ->setExplicitContent(true);
        $json = $thumbnail->jsonSerialize();

        $this->assertTrue($json['explicitContent']);
    }

    public function testExplicitContentFalse(): void
    {
        $thumbnail = (new ArticleThumbnail('https://example.com/image.jpg'))
            ->setExplicitContent(false);
        $json = $thumbnail->jsonSerialize();

        $this->assertFalse($json['explicitContent']);
    }

    public function testFullyConfigured(): void
    {
        $thumbnail = ArticleThumbnail::fromBundle('article-thumb.jpg')
            ->setCaption('Breaking news thumbnail')
            ->setAccessibilityCaption('News anchor at desk')
            ->setExplicitContent(false);

        $json = $thumbnail->jsonSerialize();

        $this->assertSame('article_thumbnail', $json['role']);
        $this->assertSame('bundle://article-thumb.jpg', $json['URL']);
        $this->assertSame('Breaking news thumbnail', $json['caption']);
        $this->assertSame('News anchor at desk', $json['accessibilityCaption']);
        $this->assertFalse($json['explicitContent']);
    }

    public function testOptionalPropertiesNotIncludedWhenNull(): void
    {
        $thumbnail = new ArticleThumbnail('https://example.com/image.jpg');
        $json = $thumbnail->jsonSerialize();

        $this->assertArrayNotHasKey('caption', $json);
        $this->assertArrayNotHasKey('accessibilityCaption', $json);
        $this->assertArrayNotHasKey('explicitContent', $json);
    }

    public function testFluentInterface(): void
    {
        $thumbnail = new ArticleThumbnail('https://example.com/image.jpg');

        $this->assertSame($thumbnail, $thumbnail->setCaption('test'));
        $this->assertSame($thumbnail, $thumbnail->setAccessibilityCaption('test'));
        $this->assertSame($thumbnail, $thumbnail->setExplicitContent(true));
    }
}
