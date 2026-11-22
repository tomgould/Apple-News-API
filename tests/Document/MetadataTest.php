<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document;

use TomGould\AppleNews\Document\Metadata;
use PHPUnit\Framework\TestCase;
use DateTime;
use DateTimeImmutable;

final class MetadataTest extends TestCase
{
    public function testEmptyMetadata(): void
    {
        $metadata = new Metadata();
        $data = $metadata->jsonSerialize();

        $this->assertEmpty($data);
    }

    public function testAddSingleAuthor(): void
    {
        $metadata = (new Metadata())->addAuthor('John Doe');
        $data = $metadata->jsonSerialize();

        $this->assertEquals(['John Doe'], $data['authors']);
    }

    public function testAddMultipleAuthors(): void
    {
        $metadata = (new Metadata())
            ->addAuthor('John Doe')
            ->addAuthor('Jane Smith');
        $data = $metadata->jsonSerialize();

        $this->assertEquals(['John Doe', 'Jane Smith'], $data['authors']);
    }

    public function testCanonicalUrl(): void
    {
        $metadata = (new Metadata())
            ->setCanonicalURL('https://example.com/article/123');
        $data = $metadata->jsonSerialize();

        $this->assertEquals('https://example.com/article/123', $data['canonicalURL']);
    }

    public function testDateCreatedWithString(): void
    {
        $metadata = (new Metadata())
            ->setDateCreated('2024-01-15T12:00:00Z');
        $data = $metadata->jsonSerialize();

        $this->assertEquals('2024-01-15T12:00:00Z', $data['dateCreated']);
    }

    public function testDateCreatedWithDateTime(): void
    {
        $date = new DateTime('2024-01-15T12:00:00+00:00');
        $metadata = (new Metadata())->setDateCreated($date);
        $data = $metadata->jsonSerialize();

        $this->assertStringStartsWith('2024-01-15T12:00:00', $data['dateCreated']);
    }

    public function testDateCreatedWithDateTimeImmutable(): void
    {
        $date = new DateTimeImmutable('2024-06-20T08:30:00+00:00');
        $metadata = (new Metadata())->setDateCreated($date);
        $data = $metadata->jsonSerialize();

        $this->assertStringStartsWith('2024-06-20T08:30:00', $data['dateCreated']);
    }

    public function testDateModified(): void
    {
        $metadata = (new Metadata())
            ->setDateModified('2024-01-16T14:30:00Z');
        $data = $metadata->jsonSerialize();

        $this->assertEquals('2024-01-16T14:30:00Z', $data['dateModified']);
    }

    public function testDatePublished(): void
    {
        $date = new DateTime('2024-01-15T10:00:00+00:00');
        $metadata = (new Metadata())->setDatePublished($date);
        $data = $metadata->jsonSerialize();

        $this->assertArrayHasKey('datePublished', $data);
    }

    public function testExcerpt(): void
    {
        $metadata = (new Metadata())
            ->setExcerpt('A brief summary of the article content.');
        $data = $metadata->jsonSerialize();

        $this->assertEquals('A brief summary of the article content.', $data['excerpt']);
    }

    public function testGeneratorInfo(): void
    {
        $metadata = (new Metadata())
            ->setGeneratorIdentifier('my-cms')
            ->setGeneratorName('My CMS')
            ->setGeneratorVersion('2.5.0');
        $data = $metadata->jsonSerialize();

        $this->assertEquals('my-cms', $data['generatorIdentifier']);
        $this->assertEquals('My CMS', $data['generatorName']);
        $this->assertEquals('2.5.0', $data['generatorVersion']);
    }

    public function testAddSingleKeyword(): void
    {
        $metadata = (new Metadata())->addKeyword('technology');
        $data = $metadata->jsonSerialize();

        $this->assertEquals(['technology'], $data['keywords']);
    }

    public function testAddMultipleKeywords(): void
    {
        $metadata = (new Metadata())
            ->addKeywords(['technology', 'news', 'innovation']);
        $data = $metadata->jsonSerialize();

        $this->assertEquals(['technology', 'news', 'innovation'], $data['keywords']);
    }

    public function testAddKeywordsMerges(): void
    {
        $metadata = (new Metadata())
            ->addKeyword('first')
            ->addKeywords(['second', 'third']);
        $data = $metadata->jsonSerialize();

        $this->assertEquals(['first', 'second', 'third'], $data['keywords']);
    }

    public function testLinkedArticle(): void
    {
        $metadata = (new Metadata())
            ->addLinkedArticle('https://example.com/related', 'related');
        $data = $metadata->jsonSerialize();

        $this->assertCount(1, $data['links']);
        $this->assertEquals('https://example.com/related', $data['links'][0]['URL']);
        $this->assertEquals('related', $data['links'][0]['relationship']);
    }

    public function testThumbnailUrl(): void
    {
        $metadata = (new Metadata())
            ->setThumbnailURL('https://example.com/thumb.jpg');
        $data = $metadata->jsonSerialize();

        $this->assertEquals('https://example.com/thumb.jpg', $data['thumbnailURL']);
    }

    public function testTransparentToolbar(): void
    {
        $metadata = (new Metadata())->setTransparentToolbar(true);
        $data = $metadata->jsonSerialize();

        $this->assertTrue($data['transparentToolbar']);
    }

    public function testVideoUrl(): void
    {
        $metadata = (new Metadata())
            ->setVideoURL('https://example.com/video.mp4');
        $data = $metadata->jsonSerialize();

        $this->assertEquals('https://example.com/video.mp4', $data['videoURL']);
    }

    public function testFullMetadata(): void
    {
        $metadata = (new Metadata())
            ->addAuthor('John Doe')
            ->setCanonicalURL('https://example.com/article')
            ->setDatePublished(new DateTime())
            ->setExcerpt('Article summary')
            ->addKeywords(['php', 'api'])
            ->setThumbnailURL('https://example.com/thumb.jpg');

        $data = $metadata->jsonSerialize();

        $this->assertArrayHasKey('authors', $data);
        $this->assertArrayHasKey('canonicalURL', $data);
        $this->assertArrayHasKey('datePublished', $data);
        $this->assertArrayHasKey('excerpt', $data);
        $this->assertArrayHasKey('keywords', $data);
        $this->assertArrayHasKey('thumbnailURL', $data);
    }
}

