<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Styles\Fills;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Styles\Fills\ColorStop;
use TomGould\AppleNews\Document\Styles\Fills\ImageFill;
use TomGould\AppleNews\Document\Styles\Fills\LinearGradientFill;
use TomGould\AppleNews\Document\Styles\Fills\RepeatableImageFill;
use TomGould\AppleNews\Document\Styles\Fills\VideoFill;

/**
 * Additional tests to achieve full coverage on fill classes.
 */
final class FillAdditionalTest extends TestCase
{
    // ==================== ImageFill ====================

    public function testImageFillSetFillMode(): void
    {
        $fill = ImageFill::fromUrl('https://example.com/bg.jpg')
            ->setFillMode('cover');

        $data = $fill->jsonSerialize();

        $this->assertSame('cover', $data['fillMode']);
    }

    public function testImageFillSetFillModeFit(): void
    {
        $fill = ImageFill::fromUrl('https://example.com/bg.jpg')
            ->setFillMode('fit');

        $data = $fill->jsonSerialize();

        $this->assertSame('fit', $data['fillMode']);
    }

    public function testImageFillAsFit(): void
    {
        $fill = ImageFill::fromUrl('https://example.com/bg.jpg')
            ->asFit();

        $data = $fill->jsonSerialize();

        $this->assertSame('fit', $data['fillMode']);
    }

    public function testImageFillAsCoverThenAsFit(): void
    {
        $fill = ImageFill::fromUrl('https://example.com/bg.jpg')
            ->asCover()
            ->asFit();

        $data = $fill->jsonSerialize();

        $this->assertSame('fit', $data['fillMode']);
    }

    public function testImageFillAllAlignments(): void
    {
        $fill = ImageFill::fromUrl('https://example.com/bg.jpg')
            ->setVerticalAlignment('bottom')
            ->setHorizontalAlignment('right');

        $data = $fill->jsonSerialize();

        $this->assertSame('bottom', $data['verticalAlignment']);
        $this->assertSame('right', $data['horizontalAlignment']);
    }

    // ==================== VideoFill ====================

    public function testVideoFillFromBundle(): void
    {
        $fill = VideoFill::fromBundle('background.mp4');

        $data = $fill->jsonSerialize();

        $this->assertSame('bundle://background.mp4', $data['URL']);
    }

    public function testVideoFillSetVerticalAlignment(): void
    {
        $fill = VideoFill::fromUrl('https://example.com/bg.mp4')
            ->setVerticalAlignment('bottom');

        $data = $fill->jsonSerialize();

        $this->assertSame('bottom', $data['verticalAlignment']);
    }

    public function testVideoFillSetHorizontalAlignment(): void
    {
        $fill = VideoFill::fromUrl('https://example.com/bg.mp4')
            ->setHorizontalAlignment('left');

        $data = $fill->jsonSerialize();

        $this->assertSame('left', $data['horizontalAlignment']);
    }

    public function testVideoFillAllProperties(): void
    {
        $fill = VideoFill::fromUrl('https://example.com/bg.mp4')
            ->setFillMode('cover')
            ->setVerticalAlignment('center')
            ->setHorizontalAlignment('center')
            ->setLoop(true)
            ->setStillURL('https://example.com/poster.jpg');

        $data = $fill->jsonSerialize();

        $this->assertSame('video', $data['type']);
        $this->assertSame('cover', $data['fillMode']);
        $this->assertSame('center', $data['verticalAlignment']);
        $this->assertSame('center', $data['horizontalAlignment']);
        $this->assertTrue($data['loop']);
        $this->assertSame('https://example.com/poster.jpg', $data['stillURL']);
    }

    // ==================== LinearGradientFill ====================

    public function testLinearGradientFillAddColorStop(): void
    {
        $fill = (new LinearGradientFill())
            ->addColorStop(ColorStop::at('#FF0000', 0))
            ->addColorStop(ColorStop::at('#00FF00', 50))
            ->addColorStop(ColorStop::at('#0000FF', 100));

        $data = $fill->jsonSerialize();

        $this->assertCount(3, $data['colorStops']);
        $this->assertSame('#FF0000', $data['colorStops'][0]['color']);
        $this->assertSame('#00FF00', $data['colorStops'][1]['color']);
        $this->assertSame('#0000FF', $data['colorStops'][2]['color']);
    }

    public function testLinearGradientFillMixedAddMethods(): void
    {
        $fill = (new LinearGradientFill())
            ->addColorStop(ColorStop::at('#FF0000', 0))
            ->addStop('#0000FF', 100)
            ->setAngle(45);

        $data = $fill->jsonSerialize();

        $this->assertCount(2, $data['colorStops']);
        $this->assertSame(45.0, $data['angle']);
    }

    // ==================== RepeatableImageFill ====================

    public function testRepeatableImageFillFromBundle(): void
    {
        $fill = RepeatableImageFill::fromBundle('pattern.png');

        $data = $fill->jsonSerialize();

        $this->assertSame('bundle://pattern.png', $data['URL']);
    }

    public function testRepeatableImageFillSetRepeat(): void
    {
        $fill = RepeatableImageFill::fromUrl('https://example.com/pattern.png')
            ->setRepeat('x');

        $data = $fill->jsonSerialize();

        $this->assertSame('x', $data['repeat']);
    }

    public function testRepeatableImageFillSetRepeatNone(): void
    {
        $fill = RepeatableImageFill::fromUrl('https://example.com/pattern.png')
            ->setRepeat('none');

        $data = $fill->jsonSerialize();

        $this->assertSame('none', $data['repeat']);
    }

    public function testRepeatableImageFillSetWidth(): void
    {
        $fill = RepeatableImageFill::fromUrl('https://example.com/pattern.png')
            ->setWidth(100);

        $data = $fill->jsonSerialize();

        $this->assertSame(100, $data['width']);
        $this->assertArrayNotHasKey('height', $data);
    }

    public function testRepeatableImageFillSetHeight(): void
    {
        $fill = RepeatableImageFill::fromUrl('https://example.com/pattern.png')
            ->setHeight(80);

        $data = $fill->jsonSerialize();

        $this->assertSame(80, $data['height']);
        $this->assertArrayNotHasKey('width', $data);
    }

    public function testRepeatableImageFillAllProperties(): void
    {
        $fill = RepeatableImageFill::fromUrl('https://example.com/pattern.png')
            ->setRepeat('both')
            ->setWidth(64)
            ->setHeight(64);

        $data = $fill->jsonSerialize();

        $this->assertSame('repeatable_image', $data['type']);
        $this->assertSame('both', $data['repeat']);
        $this->assertSame(64, $data['width']);
        $this->assertSame(64, $data['height']);
    }

    public function testRepeatableImageFillRepeatYMethod(): void
    {
        $fill = RepeatableImageFill::fromUrl('https://example.com/pattern.png')
            ->repeatY();

        $data = $fill->jsonSerialize();

        $this->assertSame('y', $data['repeat']);
    }
}
