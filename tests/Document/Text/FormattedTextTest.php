<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Text;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Additions\LinkAddition;
use TomGould\AppleNews\Document\Text\FormattedText;

final class FormattedTextTest extends TestCase
{
    public function testFormattedTextPlain(): void
    {
        $text = FormattedText::plain('Hello, world!');

        $data = $text->jsonSerialize();

        $this->assertSame('Hello, world!', $data['text']);
        $this->assertSame('none', $data['format']);
    }

    public function testFormattedTextHtml(): void
    {
        $text = FormattedText::html('<p>Hello, <strong>world</strong>!</p>');

        $data = $text->jsonSerialize();

        $this->assertSame('html', $data['format']);
    }

    public function testFormattedTextMarkdown(): void
    {
        $text = FormattedText::markdown('Hello, **world**!');

        $data = $text->jsonSerialize();

        $this->assertSame('markdown', $data['format']);
    }

    public function testFormattedTextWithTextStyle(): void
    {
        $text = FormattedText::plain('Styled text')
            ->setTextStyle('bodyText');

        $data = $text->jsonSerialize();

        $this->assertSame('bodyText', $data['textStyle']);
    }

    public function testFormattedTextWithInlineStyles(): void
    {
        $text = FormattedText::plain('Bold and italic text')
            ->addInlineTextStyle(0, 4, 'boldStyle')
            ->addInlineTextStyle(9, 6, ['fontStyle' => 'italic']);

        $data = $text->jsonSerialize();

        $this->assertCount(2, $data['inlineTextStyles']);
        $this->assertSame(0, $data['inlineTextStyles'][0]['rangeStart']);
        $this->assertSame(4, $data['inlineTextStyles'][0]['rangeLength']);
        $this->assertSame('boldStyle', $data['inlineTextStyles'][0]['textStyle']);
    }

    public function testFormattedTextWithAdditions(): void
    {
        $text = FormattedText::plain('Click here for more')
            ->addAddition(LinkAddition::forRange('https://example.com', 6, 4));

        $data = $text->jsonSerialize();

        $this->assertCount(1, $data['additions']);
        $this->assertSame('link', $data['additions'][0]['type']);
    }

    public function testFormattedTextWithMultipleAdditions(): void
    {
        $text = FormattedText::plain('Visit Apple or Google')
            ->addAddition(LinkAddition::forRange('https://apple.com', 6, 5))
            ->addAddition(LinkAddition::forRange('https://google.com', 15, 6));

        $data = $text->jsonSerialize();

        $this->assertCount(2, $data['additions']);
    }

    public function testFormattedTextSetAdditions(): void
    {
        $additions = [
            LinkAddition::forRange('https://example.com', 0, 5),
        ];

        $text = FormattedText::plain('Hello')
            ->setAdditions($additions);

        $data = $text->jsonSerialize();

        $this->assertCount(1, $data['additions']);
    }
}

