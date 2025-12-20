<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document;

use TomGould\AppleNews\Document\Layouts\Layout;
use PHPUnit\Framework\TestCase;

final class LayoutTest extends TestCase
{
    public function testBasicLayout(): void
    {
        $layout = new Layout(7, 1024);
        $data = $layout->jsonSerialize();

        $this->assertEquals(7, $data['columns']);
        $this->assertEquals(1024, $data['width']);
        $this->assertArrayNotHasKey('margin', $data);
        $this->assertArrayNotHasKey('gutter', $data);
    }

    public function testLayoutWithMargin(): void
    {
        $layout = (new Layout(7, 1024))->setMargin(60);
        $data = $layout->jsonSerialize();

        $this->assertEquals(60, $data['margin']);
    }

    public function testLayoutWithGutter(): void
    {
        $layout = (new Layout(7, 1024))->setGutter(20);
        $data = $layout->jsonSerialize();

        $this->assertEquals(20, $data['gutter']);
    }

    public function testLayoutWithAllOptions(): void
    {
        $layout = (new Layout(12, 1280))
            ->setMargin(75)
            ->setGutter(25);
        $data = $layout->jsonSerialize();

        $this->assertEquals(12, $data['columns']);
        $this->assertEquals(1280, $data['width']);
        $this->assertEquals(75, $data['margin']);
        $this->assertEquals(25, $data['gutter']);
    }

    public function testLayoutFluentInterface(): void
    {
        $layout = new Layout(7, 1024);

        $result = $layout->setMargin(50);
        $this->assertSame($layout, $result);

        $result = $layout->setGutter(15);
        $this->assertSame($layout, $result);
    }
}

