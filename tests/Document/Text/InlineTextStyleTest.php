<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Text;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Text\InlineTextStyle;

final class InlineTextStyleTest extends TestCase
{
    public function testInlineTextStyleBasic(): void
    {
        $style = InlineTextStyle::forRange(0, 10)
            ->withStyle('boldStyle');

        $data = $style->jsonSerialize();

        $this->assertSame(0, $data['rangeStart']);
        $this->assertSame(10, $data['rangeLength']);
        $this->assertSame('boldStyle', $data['textStyle']);
    }

    public function testInlineTextStyleWithInlineDefinition(): void
    {
        $style = InlineTextStyle::forRange(5, 8)
            ->withInlineStyle(['fontWeight' => 'bold', 'textColor' => '#FF0000']);

        $data = $style->jsonSerialize();

        $this->assertIsArray($data['textStyle']);
        $this->assertSame('bold', $data['textStyle']['fontWeight']);
        $this->assertSame('#FF0000', $data['textStyle']['textColor']);
    }

    public function testInlineTextStyleBold(): void
    {
        $style = InlineTextStyle::bold(0, 5);

        $data = $style->jsonSerialize();

        $this->assertSame('bold', $data['textStyle']['fontWeight']);
    }

    public function testInlineTextStyleItalic(): void
    {
        $style = InlineTextStyle::italic(10, 8);

        $data = $style->jsonSerialize();

        $this->assertSame('italic', $data['textStyle']['fontStyle']);
    }

    public function testInlineTextStyleColored(): void
    {
        $style = InlineTextStyle::colored(0, 12, '#0066CC');

        $data = $style->jsonSerialize();

        $this->assertSame('#0066CC', $data['textStyle']['textColor']);
    }
}
