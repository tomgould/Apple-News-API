<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document\Components;

use PHPUnit\Framework\TestCase;
use TomGould\AppleNews\Document\Components\ArticleLink;
use TomGould\AppleNews\Document\Components\Aside;
use TomGould\AppleNews\Document\Components\Body;
use TomGould\AppleNews\Document\Components\Chapter;
use TomGould\AppleNews\Document\Components\Header;
use TomGould\AppleNews\Document\Components\Photo;
use TomGould\AppleNews\Document\Components\Section;
use TomGould\AppleNews\Document\Components\Title;

final class ContainerComponentsTest extends TestCase
{
    public function testSectionComponent(): void
    {
        $section = new Section();

        $data = $section->jsonSerialize();

        $this->assertSame('section', $data['role']);
    }

    public function testSectionWithComponents(): void
    {
        $section = (new Section())
            ->addComponent(new Title('Section Title'))
            ->addComponent(new Body('Section content here.'));

        $data = $section->jsonSerialize();

        $this->assertSame('section', $data['role']);
        $this->assertCount(2, $data['components']);
        $this->assertSame('title', $data['components'][0]['role']);
        $this->assertSame('body', $data['components'][1]['role']);
    }

    public function testSectionWithScene(): void
    {
        $section = (new Section())
            ->setScene([
                'type' => 'fading_sticky_header',
                'fadeColor' => '#000000',
            ]);

        $data = $section->jsonSerialize();

        $this->assertSame('section', $data['role']);
        $this->assertSame([
            'type' => 'fading_sticky_header',
            'fadeColor' => '#000000',
        ], $data['scene']);
    }

    public function testChapterComponent(): void
    {
        $chapter = new Chapter();

        $data = $chapter->jsonSerialize();

        $this->assertSame('chapter', $data['role']);
    }

    public function testChapterWithComponents(): void
    {
        $chapter = (new Chapter())
            ->addComponent(new Title('Chapter 1'))
            ->addComponent(new Body('Once upon a time...'));

        $data = $chapter->jsonSerialize();

        $this->assertSame('chapter', $data['role']);
        $this->assertCount(2, $data['components']);
    }

    public function testChapterWithScene(): void
    {
        $chapter = (new Chapter())
            ->setScene([
                'type' => 'parallax_scale',
                'component' => 'header-image',
            ]);

        $data = $chapter->jsonSerialize();

        $this->assertSame([
            'type' => 'parallax_scale',
            'component' => 'header-image',
        ], $data['scene']);
    }

    public function testHeaderComponent(): void
    {
        $header = new Header();

        $data = $header->jsonSerialize();

        $this->assertSame('header', $data['role']);
    }

    public function testHeaderWithComponents(): void
    {
        $header = (new Header())
            ->addComponent(Photo::fromUrl('https://example.com/hero.jpg'))
            ->addComponent(new Title('Article Title'));

        $data = $header->jsonSerialize();

        $this->assertSame('header', $data['role']);
        $this->assertCount(2, $data['components']);
        $this->assertSame('photo', $data['components'][0]['role']);
        $this->assertSame('title', $data['components'][1]['role']);
    }

    public function testAsideComponent(): void
    {
        $aside = new Aside();

        $data = $aside->jsonSerialize();

        $this->assertSame('aside', $data['role']);
    }

    public function testAsideWithComponents(): void
    {
        $aside = (new Aside())
            ->addComponent(new Title('Related Information'))
            ->addComponent(new Body('This is sidebar content.'));

        $data = $aside->jsonSerialize();

        $this->assertSame('aside', $data['role']);
        $this->assertCount(2, $data['components']);
    }

    public function testArticleLinkComponent(): void
    {
        $link = new ArticleLink('ABCDEF123456');

        $data = $link->jsonSerialize();

        $this->assertSame('article_link', $data['role']);
        $this->assertSame('ABCDEF123456', $data['articleIdentifier']);
    }

    public function testArticleLinkFromArticleId(): void
    {
        $link = ArticleLink::fromArticleId('XYZ789');

        $data = $link->jsonSerialize();

        $this->assertSame('article_link', $data['role']);
        $this->assertSame('XYZ789', $data['articleIdentifier']);
    }

    public function testArticleLinkWithBaseProperties(): void
    {
        $link = (new ArticleLink('ABC123'))
            ->setIdentifier('related-article')
            ->setLayout('linkLayout')
            ->setStyle('linkStyle');

        $data = $link->jsonSerialize();

        $this->assertSame('article_link', $data['role']);
        $this->assertSame('ABC123', $data['articleIdentifier']);
        $this->assertSame('related-article', $data['identifier']);
        $this->assertSame('linkLayout', $data['layout']);
        $this->assertSame('linkStyle', $data['style']);
    }

    public function testContainerWithContentDisplay(): void
    {
        $section = (new Section())
            ->setContentDisplay('horizontal')
            ->addComponent(new Body('Item 1'))
            ->addComponent(new Body('Item 2'));

        $data = $section->jsonSerialize();

        $this->assertSame('horizontal', $data['contentDisplay']);
    }
}
