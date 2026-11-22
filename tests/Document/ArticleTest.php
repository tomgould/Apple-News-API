<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document;

use TomGould\AppleNews\Document\Article;
use TomGould\AppleNews\Document\Components\Body;
use TomGould\AppleNews\Document\Components\Photo;
use TomGould\AppleNews\Document\Components\Title;
use TomGould\AppleNews\Document\Layouts\Layout;
use TomGould\AppleNews\Document\Metadata;
use TomGould\AppleNews\Document\Styles\DocumentStyle;
use PHPUnit\Framework\TestCase;

final class ArticleTest extends TestCase
{
    public function testCreateArticleWithBasicProperties(): void
    {
        $article = Article::create(
            identifier: 'test-123',
            title: 'Test Article',
            language: 'en'
        );

        $this->assertEquals('test-123', $article->getIdentifier());
        $this->assertEquals('Test Article', $article->getTitle());
    }

    public function testAddComponents(): void
    {
        $article = Article::create('test', 'Test', 'en');

        $article
            ->addComponent(new Title('Hello'))
            ->addComponent(new Body('World'));

        $this->assertCount(2, $article->getComponents());
    }

    public function testSerializeToJson(): void
    {
        $article = Article::create(
            identifier: 'test-article',
            title: 'My Article',
            language: 'en'
        );

        $article->addComponent(new Title('Welcome'));

        $json = $article->toJson();
        $data = json_decode($json, true);

        $this->assertArrayHasKey('version', $data);
        $this->assertArrayHasKey('identifier', $data);
        $this->assertArrayHasKey('title', $data);
        $this->assertArrayHasKey('language', $data);
        $this->assertArrayHasKey('layout', $data);
        $this->assertArrayHasKey('components', $data);

        $this->assertEquals('test-article', $data['identifier']);
        $this->assertEquals('My Article', $data['title']);
        $this->assertEquals('en', $data['language']);
    }

    public function testComponentsSerializeCorrectly(): void
    {
        $article = Article::create('test', 'Test', 'en');

        $article
            ->addComponent(
                (new Title('Hello World'))
                    ->setLayout('titleLayout')
            )
            ->addComponent(
                (new Body('This is body text'))
                    ->setFormat('html')
            )
            ->addComponent(
                Photo::fromUrl('https://example.com/image.jpg')
                    ->setCaption('A photo')
            );

        $data = json_decode($article->toJson(), true);

        $this->assertCount(3, $data['components']);

        // Title component
        $this->assertEquals('title', $data['components'][0]['role']);
        $this->assertEquals('Hello World', $data['components'][0]['text']);
        $this->assertEquals('titleLayout', $data['components'][0]['layout']);

        // Body component
        $this->assertEquals('body', $data['components'][1]['role']);
        $this->assertEquals('html', $data['components'][1]['format']);

        // Photo component
        $this->assertEquals('photo', $data['components'][2]['role']);
        $this->assertEquals('https://example.com/image.jpg', $data['components'][2]['URL']);
        $this->assertEquals('A photo', $data['components'][2]['caption']);
    }

    public function testMetadataSerializesCorrectly(): void
    {
        $article = Article::create('test', 'Test', 'en');

        $metadata = (new Metadata())
            ->setCanonicalURL('https://example.com/article')
            ->setDatePublished('2024-01-15T12:00:00Z')
            ->addAuthor('John Doe')
            ->addKeywords(['news', 'tech']);

        $article->setMetadata($metadata);

        $data = json_decode($article->toJson(), true);

        $this->assertArrayHasKey('metadata', $data);
        $this->assertEquals('https://example.com/article', $data['metadata']['canonicalURL']);
        $this->assertEquals(['John Doe'], $data['metadata']['authors']);
        $this->assertEquals(['news', 'tech'], $data['metadata']['keywords']);
    }

    public function testDocumentStyleSerializesCorrectly(): void
    {
        $article = Article::create('test', 'Test', 'en');

        $style = (new DocumentStyle())->setBackgroundColor('#F7F7F7');
        $article->setDocumentStyle($style);

        $data = json_decode($article->toJson(), true);

        $this->assertArrayHasKey('documentStyle', $data);
        $this->assertEquals('#F7F7F7', $data['documentStyle']['backgroundColor']);
    }

    public function testLayoutSerializesCorrectly(): void
    {
        $layout = new Layout(7, 1024);
        $layout->setMargin(75)->setGutter(20);

        $article = new Article('test', 'Test', 'en', $layout);

        $data = json_decode($article->toJson(), true);

        $this->assertEquals(7, $data['layout']['columns']);
        $this->assertEquals(1024, $data['layout']['width']);
        $this->assertEquals(75, $data['layout']['margin']);
        $this->assertEquals(20, $data['layout']['gutter']);
    }

    public function testPhotoFromBundle(): void
    {
        $photo = Photo::fromBundle('hero.jpg');

        $data = $photo->jsonSerialize();

        $this->assertEquals('bundle://hero.jpg', $data['URL']);
    }
}
