<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Text;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Additions\LinkAddition;
use TomGould\AppleNews\Document\Text\CaptionDescriptor;

final class CaptionDescriptorTest extends TestCase
{
    public function testCaptionDescriptorPlain(): void
    {
        $caption = CaptionDescriptor::plain('A beautiful sunset');

        $data = $caption->jsonSerialize();

        $this->assertSame('A beautiful sunset', $data['text']);
        $this->assertSame('none', $data['format']);
    }

    public function testCaptionDescriptorHtml(): void
    {
        $caption = CaptionDescriptor::html('Photo by <em>Jane Doe</em>');

        $data = $caption->jsonSerialize();

        $this->assertSame('html', $data['format']);
    }

    public function testCaptionDescriptorMarkdown(): void
    {
        $caption = CaptionDescriptor::markdown('Photo by *Jane Doe*');

        $data = $caption->jsonSerialize();

        $this->assertSame('markdown', $data['format']);
    }

    public function testCaptionDescriptorWithTextStyle(): void
    {
        $caption = CaptionDescriptor::plain('Caption text')
            ->setTextStyle('captionStyle');

        $data = $caption->jsonSerialize();

        $this->assertSame('captionStyle', $data['textStyle']);
    }

    public function testCaptionDescriptorWithInlineStyles(): void
    {
        $caption = CaptionDescriptor::plain('Photo credit: John Smith')
            ->addInlineTextStyle(14, 10, 'boldStyle');

        $data = $caption->jsonSerialize();

        $this->assertCount(1, $data['inlineTextStyles']);
    }

    public function testCaptionDescriptorWithLink(): void
    {
        $caption = CaptionDescriptor::plain('Photo by Jane Doe')
            ->addAddition(LinkAddition::forRange('https://janedoe.com', 9, 8));

        $data = $caption->jsonSerialize();

        $this->assertCount(1, $data['additions']);
        $this->assertSame('https://janedoe.com', $data['additions'][0]['URL']);
    }

    public function testCaptionDescriptorComplete(): void
    {
        $caption = CaptionDescriptor::html('Photo by <a href="#">Jane Doe</a>')
            ->setTextStyle('captionStyle')
            ->addInlineTextStyle(9, 8, ['fontWeight' => 'bold'])
            ->addAddition(LinkAddition::forRange('https://janedoe.com', 9, 8));

        $data = $caption->jsonSerialize();

        $this->assertArrayHasKey('text', $data);
        $this->assertArrayHasKey('format', $data);
        $this->assertArrayHasKey('textStyle', $data);
        $this->assertArrayHasKey('inlineTextStyles', $data);
        $this->assertArrayHasKey('additions', $data);
    }
}

