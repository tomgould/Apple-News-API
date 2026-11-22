<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Styles;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Styles\ListItemStyle;
use TomGould\AppleNews\Document\Styles\TextShadow;
use TomGould\AppleNews\Document\Styles\TextShadowOffset;
use TomGould\AppleNews\Document\Styles\TextStrokeStyle;

final class TextStyleTest extends TestCase
{
    public function testTextShadowOffset(): void
    {
        $offset = TextShadowOffset::create(2.0, 3.0);

        $data = $offset->jsonSerialize();

        $this->assertSame(2.0, $data['x']);
        $this->assertSame(3.0, $data['y']);
    }

    public function testTextShadowDropShadow(): void
    {
        $shadow = TextShadow::dropShadow('#00000066', 2, 1, 1);

        $data = $shadow->jsonSerialize();

        $this->assertSame('#00000066', $data['color']);
        $this->assertSame(2, $data['radius']);
        $this->assertSame(1.0, $data['offset']['x']);
        $this->assertSame(1.0, $data['offset']['y']);
    }

    public function testTextShadowSubtle(): void
    {
        $shadow = TextShadow::subtle();

        $data = $shadow->jsonSerialize();

        $this->assertSame('#00000033', $data['color']);
        $this->assertSame(1, $data['radius']);
    }

    public function testTextShadowManual(): void
    {
        $shadow = (new TextShadow())
            ->setColor('#000000')
            ->setRadius(5)
            ->setOffset(TextShadowOffset::create(2, 4));

        $data = $shadow->jsonSerialize();

        $this->assertSame(5, $data['radius']);
    }

    public function testTextStrokeStyle(): void
    {
        $stroke = TextStrokeStyle::create('#FFFFFF', 2);

        $data = $stroke->jsonSerialize();

        $this->assertSame('#FFFFFF', $data['color']);
        $this->assertSame(2, $data['width']);
    }

    public function testListItemStyleBullet(): void
    {
        $style = ListItemStyle::bullet();

        $data = $style->jsonSerialize();

        $this->assertSame('bullet', $data['type']);
    }

    public function testListItemStyleDecimal(): void
    {
        $style = ListItemStyle::decimal();

        $data = $style->jsonSerialize();

        $this->assertSame('decimal', $data['type']);
    }

    public function testListItemStyleAlpha(): void
    {
        $lower = ListItemStyle::lowerAlpha();
        $upper = ListItemStyle::upperAlpha();

        $this->assertSame('lower_alphabetical', $lower->jsonSerialize()['type']);
        $this->assertSame('upper_alphabetical', $upper->jsonSerialize()['type']);
    }

    public function testListItemStyleRoman(): void
    {
        $lower = ListItemStyle::lowerRoman();
        $upper = ListItemStyle::upperRoman();

        $this->assertSame('lower_roman', $lower->jsonSerialize()['type']);
        $this->assertSame('upper_roman', $upper->jsonSerialize()['type']);
    }

    public function testListItemStyleCustomCharacter(): void
    {
        $style = ListItemStyle::withCharacter('→');

        $data = $style->jsonSerialize();

        $this->assertSame('character', $data['type']);
        $this->assertSame('→', $data['character']);
    }

    public function testListItemStyleNone(): void
    {
        $style = ListItemStyle::none();

        $data = $style->jsonSerialize();

        $this->assertSame('none', $data['type']);
    }
}

