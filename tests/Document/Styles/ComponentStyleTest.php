<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Styles;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Styles\ComponentShadow;
use TomGould\AppleNews\Document\Styles\CornerMask;

final class ComponentStyleTest extends TestCase
{
    public function testComponentShadowSubtle(): void
    {
        $shadow = ComponentShadow::subtle();

        $data = $shadow->jsonSerialize();

        $this->assertSame('#000000', $data['color']);
        $this->assertSame(4, $data['radius']);
        $this->assertSame(0.1, $data['opacity']);
        $this->assertSame(0, $data['offset']['x']);
        $this->assertSame(2, $data['offset']['y']);
    }

    public function testComponentShadowMedium(): void
    {
        $shadow = ComponentShadow::medium();

        $data = $shadow->jsonSerialize();

        $this->assertSame(8, $data['radius']);
        $this->assertSame(0.15, $data['opacity']);
    }

    public function testComponentShadowStrong(): void
    {
        $shadow = ComponentShadow::strong();

        $data = $shadow->jsonSerialize();

        $this->assertSame(16, $data['radius']);
        $this->assertSame(0.2, $data['opacity']);
    }

    public function testComponentShadowCustom(): void
    {
        $shadow = (new ComponentShadow())
            ->setColor('#333333')
            ->setRadius(10)
            ->setOpacity(0.25)
            ->setOffset(5, 10);

        $data = $shadow->jsonSerialize();

        $this->assertSame('#333333', $data['color']);
        $this->assertSame(10, $data['radius']);
        $this->assertSame(0.25, $data['opacity']);
        $this->assertSame(5, $data['offset']['x']);
        $this->assertSame(10, $data['offset']['y']);
    }

    public function testCornerMaskUniform(): void
    {
        $mask = CornerMask::uniform(12);

        $data = $mask->jsonSerialize();

        $this->assertSame('corners', $data['type']);
        $this->assertSame(12, $data['radius']);
    }

    public function testCornerMaskTopOnly(): void
    {
        $mask = CornerMask::topOnly(8);

        $data = $mask->jsonSerialize();

        $this->assertTrue($data['topLeft']);
        $this->assertTrue($data['topRight']);
        $this->assertFalse($data['bottomLeft']);
        $this->assertFalse($data['bottomRight']);
    }

    public function testCornerMaskBottomOnly(): void
    {
        $mask = CornerMask::bottomOnly(8);

        $data = $mask->jsonSerialize();

        $this->assertFalse($data['topLeft']);
        $this->assertFalse($data['topRight']);
        $this->assertTrue($data['bottomLeft']);
        $this->assertTrue($data['bottomRight']);
    }

    public function testCornerMaskCustomCorners(): void
    {
        $mask = (new CornerMask())
            ->setRadius(10)
            ->setCorners(true, false, true, false);

        $data = $mask->jsonSerialize();

        $this->assertTrue($data['topLeft']);
        $this->assertFalse($data['topRight']);
        $this->assertTrue($data['bottomLeft']);
        $this->assertFalse($data['bottomRight']);
    }
}

