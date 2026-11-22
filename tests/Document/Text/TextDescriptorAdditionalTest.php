<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Text;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Additions\LinkAddition;
use TomGould\AppleNews\Document\Text\CaptionDescriptor;
use TomGould\AppleNews\Document\Text\FormattedText;

/**
 * Additional tests to achieve full coverage on text descriptor classes.
 */
final class TextDescriptorAdditionalTest extends TestCase
{
    // ==================== CaptionDescriptor ====================

    public function testCaptionDescriptorSetInlineTextStyles(): void
    {
        $caption = CaptionDescriptor::plain('Photo by Jane Doe')
            ->setInlineTextStyles([
                ['rangeStart' => 9, 'rangeLength' => 8, 'textStyle' => 'boldStyle'],
            ]);

        $data = $caption->jsonSerialize();

        $this->assertArrayHasKey('inlineTextStyles', $data);
        $this->assertCount(1, $data['inlineTextStyles']);
        $this->assertSame(9, $data['inlineTextStyles'][0]['rangeStart']);
    }

    public function testCaptionDescriptorSetAdditions(): void
    {
        $caption = CaptionDescriptor::plain('Visit our website')
            ->setAdditions([
                LinkAddition::forRange('https://example.com', 10, 7),
            ]);

        $data = $caption->jsonSerialize();

        $this->assertArrayHasKey('additions', $data);
        $this->assertCount(1, $data['additions']);
        $this->assertSame('link', $data['additions'][0]['type']);
    }

    public function testCaptionDescriptorSetInlineTextStylesOverridesAdd(): void
    {
        $caption = CaptionDescriptor::plain('Test text')
            ->addInlineTextStyle(0, 4, 'style1')
            ->setInlineTextStyles([
                ['rangeStart' => 5, 'rangeLength' => 4, 'textStyle' => 'style2'],
            ]);

        $data = $caption->jsonSerialize();

        // setInlineTextStyles should replace, not append
        $this->assertCount(1, $data['inlineTextStyles']);
        $this->assertSame(5, $data['inlineTextStyles'][0]['rangeStart']);
    }

    public function testCaptionDescriptorSetAdditionsOverridesAdd(): void
    {
        $caption = CaptionDescriptor::plain('Link one and link two')
            ->addAddition(LinkAddition::forRange('https://one.com', 0, 8))
            ->setAdditions([
                LinkAddition::forRange('https://two.com', 13, 8),
            ]);

        $data = $caption->jsonSerialize();

        // setAdditions should replace, not append
        $this->assertCount(1, $data['additions']);
        $this->assertSame('https://two.com', $data['additions'][0]['URL']);
    }

    // ==================== FormattedText ====================

    public function testFormattedTextSetInlineTextStyles(): void
    {
        $text = FormattedText::plain('Bold and italic text')
            ->setInlineTextStyles([
                ['rangeStart' => 0, 'rangeLength' => 4, 'textStyle' => 'boldStyle'],
                ['rangeStart' => 9, 'rangeLength' => 6, 'textStyle' => 'italicStyle'],
            ]);

        $data = $text->jsonSerialize();

        $this->assertArrayHasKey('inlineTextStyles', $data);
        $this->assertCount(2, $data['inlineTextStyles']);
    }

    public function testFormattedTextSetInlineTextStylesOverridesAdd(): void
    {
        $text = FormattedText::plain('Test text here')
            ->addInlineTextStyle(0, 4, 'oldStyle')
            ->setInlineTextStyles([
                ['rangeStart' => 5, 'rangeLength' => 4, 'textStyle' => 'newStyle'],
            ]);

        $data = $text->jsonSerialize();

        // setInlineTextStyles should replace
        $this->assertCount(1, $data['inlineTextStyles']);
        $this->assertSame(5, $data['inlineTextStyles'][0]['rangeStart']);
    }
}

