<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Components;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Components\ArticleTitle;

/**
 * Tests for the ArticleTitle component.
 */
final class ArticleTitleTest extends TestCase
{
    public function testBasicConstruction(): void
    {
        $title = new ArticleTitle('Breaking News: Major Event');
        $json = $title->jsonSerialize();

        $this->assertSame('article_title', $json['role']);
        $this->assertSame('Breaking News: Major Event', $json['text']);
    }

    public function testWithTextStyle(): void
    {
        $title = (new ArticleTitle('Headline'))
            ->setTextStyle('headlineStyle');
        $json = $title->jsonSerialize();

        $this->assertSame('article_title', $json['role']);
        $this->assertSame('Headline', $json['text']);
        $this->assertSame('headlineStyle', $json['textStyle']);
    }

    public function testWithFormat(): void
    {
        $title = (new ArticleTitle('<b>Bold Headline</b>'))
            ->setFormat('html');
        $json = $title->jsonSerialize();

        $this->assertSame('html', $json['format']);
    }

    public function testWithMarkdownFormat(): void
    {
        $title = (new ArticleTitle('**Bold** and *italic*'))
            ->setFormat('markdown');
        $json = $title->jsonSerialize();

        $this->assertSame('markdown', $json['format']);
    }

    public function testWithInlineTextStyles(): void
    {
        $title = (new ArticleTitle('Styled Title'))
            ->setInlineTextStyles([
                [
                    'rangeStart' => 0,
                    'rangeLength' => 6,
                    'textStyle' => 'boldStyle',
                ],
            ]);
        $json = $title->jsonSerialize();

        $this->assertArrayHasKey('inlineTextStyles', $json);
        $this->assertCount(1, $json['inlineTextStyles']);
        $this->assertSame(0, $json['inlineTextStyles'][0]['rangeStart']);
    }

    public function testWithAdditions(): void
    {
        $title = (new ArticleTitle('Click here for more'))
            ->setAdditions([
                [
                    'type' => 'link',
                    'rangeStart' => 0,
                    'rangeLength' => 10,
                    'URL' => 'https://example.com',
                ],
            ]);
        $json = $title->jsonSerialize();

        $this->assertArrayHasKey('additions', $json);
        $this->assertSame('link', $json['additions'][0]['type']);
    }

    public function testExtendsTextComponent(): void
    {
        $title = new ArticleTitle('Test');

        $this->assertInstanceOf(\TomGould\AppleNews\Document\Components\TextComponent::class, $title);
    }

    public function testEmptyText(): void
    {
        $title = new ArticleTitle('');
        $json = $title->jsonSerialize();

        $this->assertSame('article_title', $json['role']);
        $this->assertSame('', $json['text']);
    }

    public function testUnicodeText(): void
    {
        $title = new ArticleTitle('日本語のタイトル 🎉');
        $json = $title->jsonSerialize();

        $this->assertSame('日本語のタイトル 🎉', $json['text']);
    }
}
