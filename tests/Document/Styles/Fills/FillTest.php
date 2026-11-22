<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Styles\Fills;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Styles\Fills\ColorStop;
use TomGould\AppleNews\Document\Styles\Fills\FillInterface;
use TomGould\AppleNews\Document\Styles\Fills\ImageFill;
use TomGould\AppleNews\Document\Styles\Fills\LinearGradientFill;
use TomGould\AppleNews\Document\Styles\Fills\RepeatableImageFill;
use TomGould\AppleNews\Document\Styles\Fills\VideoFill;

final class FillTest extends TestCase
{
    public function testColorStop(): void
    {
        $stop = ColorStop::at('#FF0000', 50);

        $data = $stop->jsonSerialize();

        $this->assertSame('#FF0000', $data['color']);
        $this->assertSame(50.0, $data['location']);
    }

    public function testImageFillFromUrl(): void
    {
        $fill = ImageFill::fromUrl('https://example.com/bg.jpg');

        $data = $fill->jsonSerialize();

        $this->assertSame('image', $data['type']);
        $this->assertSame('https://example.com/bg.jpg', $data['URL']);
    }

    public function testImageFillFromBundle(): void
    {
        $fill = ImageFill::fromBundle('background.jpg');

        $data = $fill->jsonSerialize();

        $this->assertSame('bundle://background.jpg', $data['URL']);
    }

    public function testImageFillWithOptions(): void
    {
        $fill = ImageFill::fromUrl('https://example.com/bg.jpg')
            ->asCover()
            ->setVerticalAlignment('top')
            ->setHorizontalAlignment('center');

        $data = $fill->jsonSerialize();

        $this->assertSame('cover', $data['fillMode']);
        $this->assertSame('top', $data['verticalAlignment']);
        $this->assertSame('center', $data['horizontalAlignment']);
    }

    public function testVideoFillFromUrl(): void
    {
        $fill = VideoFill::fromUrl('https://example.com/bg.mp4');

        $data = $fill->jsonSerialize();

        $this->assertSame('video', $data['type']);
        $this->assertSame('https://example.com/bg.mp4', $data['URL']);
    }

    public function testVideoFillWithOptions(): void
    {
        $fill = VideoFill::fromUrl('https://example.com/bg.mp4')
            ->setLoop(true)
            ->setStillURL('https://example.com/poster.jpg')
            ->setFillMode('cover');

        $data = $fill->jsonSerialize();

        $this->assertTrue($data['loop']);
        $this->assertSame('https://example.com/poster.jpg', $data['stillURL']);
        $this->assertSame('cover', $data['fillMode']);
    }

    public function testLinearGradientFillVertical(): void
    {
        $fill = LinearGradientFill::vertical('#000000', '#FFFFFF');

        $data = $fill->jsonSerialize();

        $this->assertSame('linear_gradient', $data['type']);
        $this->assertSame(180.0, $data['angle']);
        $this->assertCount(2, $data['colorStops']);
        $this->assertSame('#000000', $data['colorStops'][0]['color']);
        $this->assertSame(0.0, $data['colorStops'][0]['location']);
        $this->assertSame('#FFFFFF', $data['colorStops'][1]['color']);
        $this->assertSame(100.0, $data['colorStops'][1]['location']);
    }

    public function testLinearGradientFillHorizontal(): void
    {
        $fill = LinearGradientFill::horizontal('#FF0000', '#0000FF');

        $data = $fill->jsonSerialize();

        $this->assertSame(90.0, $data['angle']);
    }

    public function testLinearGradientFillDiagonal(): void
    {
        $fill = LinearGradientFill::diagonal('#FF0000', '#0000FF');

        $data = $fill->jsonSerialize();

        $this->assertSame(135.0, $data['angle']);
    }

    public function testLinearGradientFillCustom(): void
    {
        $fill = (new LinearGradientFill())
            ->addStop('#FF0000', 0)
            ->addStop('#00FF00', 50)
            ->addStop('#0000FF', 100)
            ->setAngle(45);

        $data = $fill->jsonSerialize();

        $this->assertCount(3, $data['colorStops']);
        $this->assertSame(45.0, $data['angle']);
    }

    public function testRepeatableImageFillFromUrl(): void
    {
        $fill = RepeatableImageFill::fromUrl('https://example.com/pattern.png');

        $data = $fill->jsonSerialize();

        $this->assertSame('repeatable_image', $data['type']);
        $this->assertSame('https://example.com/pattern.png', $data['URL']);
    }

    public function testRepeatableImageFillWithOptions(): void
    {
        $fill = RepeatableImageFill::fromUrl('https://example.com/pattern.png')
            ->repeatBoth()
            ->setSize(64, 64);

        $data = $fill->jsonSerialize();

        $this->assertSame('both', $data['repeat']);
        $this->assertSame(64, $data['width']);
        $this->assertSame(64, $data['height']);
    }

    public function testRepeatableImageFillRepeatModes(): void
    {
        $both = RepeatableImageFill::fromUrl('https://example.com/p.png')->repeatBoth();
        $x = RepeatableImageFill::fromUrl('https://example.com/p.png')->repeatX();
        $y = RepeatableImageFill::fromUrl('https://example.com/p.png')->repeatY();

        $this->assertSame('both', $both->jsonSerialize()['repeat']);
        $this->assertSame('x', $x->jsonSerialize()['repeat']);
        $this->assertSame('y', $y->jsonSerialize()['repeat']);
    }

    public function testAllFillsImplementInterface(): void
    {
        $fills = [
            ImageFill::fromUrl('https://example.com/a.jpg'),
            VideoFill::fromUrl('https://example.com/b.mp4'),
            LinearGradientFill::vertical('#000', '#FFF'),
            RepeatableImageFill::fromUrl('https://example.com/c.png'),
        ];

        foreach ($fills as $fill) {
            $this->assertInstanceOf(FillInterface::class, $fill);
        }
    }
}
