<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Components;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Components\Author;
use TomGould\AppleNews\Document\Components\Byline;
use TomGould\AppleNews\Document\Components\Illustrator;
use TomGould\AppleNews\Document\Components\Intro;
use TomGould\AppleNews\Document\Components\Photographer;
use TomGould\AppleNews\Document\Components\Quote;

final class TextComponentsTest extends TestCase
{
    public function testIntroComponent(): void
    {
        $intro = new Intro('This is the introductory paragraph.');

        $data = $intro->jsonSerialize();

        $this->assertSame('intro', $data['role']);
        $this->assertSame('This is the introductory paragraph.', $data['text']);
    }

    public function testIntroWithFormatting(): void
    {
        $intro = (new Intro('<p>Formatted intro</p>'))
            ->setFormat('html')
            ->setTextStyle('introStyle');

        $data = $intro->jsonSerialize();

        $this->assertSame('intro', $data['role']);
        $this->assertSame('<p>Formatted intro</p>', $data['text']);
        $this->assertSame('html', $data['format']);
        $this->assertSame('introStyle', $data['textStyle']);
    }

    public function testBylineComponent(): void
    {
        $byline = new Byline('By John Doe | January 15, 2024');

        $data = $byline->jsonSerialize();

        $this->assertSame('byline', $data['role']);
        $this->assertSame('By John Doe | January 15, 2024', $data['text']);
    }

    public function testAuthorComponent(): void
    {
        $author = new Author('Jane Smith');

        $data = $author->jsonSerialize();

        $this->assertSame('author', $data['role']);
        $this->assertSame('Jane Smith', $data['text']);
    }

    public function testIllustratorComponent(): void
    {
        $illustrator = new Illustrator('Illustrations by Alex Johnson');

        $data = $illustrator->jsonSerialize();

        $this->assertSame('illustrator', $data['role']);
        $this->assertSame('Illustrations by Alex Johnson', $data['text']);
    }

    public function testPhotographerComponent(): void
    {
        $photographer = new Photographer('Photos by Sam Wilson');

        $data = $photographer->jsonSerialize();

        $this->assertSame('photographer', $data['role']);
        $this->assertSame('Photos by Sam Wilson', $data['text']);
    }

    public function testQuoteComponent(): void
    {
        $quote = new Quote('To be or not to be, that is the question.');

        $data = $quote->jsonSerialize();

        $this->assertSame('quote', $data['role']);
        $this->assertSame('To be or not to be, that is the question.', $data['text']);
    }

    public function testQuoteWithHtmlFormat(): void
    {
        $quote = (new Quote('<p>A formatted quotation.</p>'))
            ->setFormat('html');

        $data = $quote->jsonSerialize();

        $this->assertSame('quote', $data['role']);
        $this->assertSame('html', $data['format']);
    }

    public function testTextComponentsWithBaseProperties(): void
    {
        $author = (new Author('Test Author'))
            ->setIdentifier('author-1')
            ->setLayout('authorLayout')
            ->setStyle('authorStyle')
            ->setHidden(false);

        $data = $author->jsonSerialize();

        $this->assertSame('author', $data['role']);
        $this->assertSame('author-1', $data['identifier']);
        $this->assertSame('authorLayout', $data['layout']);
        $this->assertSame('authorStyle', $data['style']);
        $this->assertArrayNotHasKey('hidden', $data);
    }
}
