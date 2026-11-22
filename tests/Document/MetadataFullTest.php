<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Document;

use TomGould\AppleNews\Document\Metadata;
use PHPUnit\Framework\TestCase;
use DateTime;
use DateTimeImmutable;

/**
 * Additional Metadata tests for full coverage.
 */
final class MetadataFullTest extends TestCase
{
    public function testSetDateModifiedWithDateTime(): void
    {
        $date = new DateTime('2024-06-15T14:30:00+00:00');
        $metadata = (new Metadata())->setDateModified($date);
        $data = $metadata->jsonSerialize();

        $this->assertArrayHasKey('dateModified', $data);
        $this->assertStringStartsWith('2024-06-15T14:30:00', $data['dateModified']);
    }

    public function testSetDateModifiedWithDateTimeImmutable(): void
    {
        $date = new DateTimeImmutable('2024-12-25T08:00:00+00:00');
        $metadata = (new Metadata())->setDateModified($date);
        $data = $metadata->jsonSerialize();

        $this->assertArrayHasKey('dateModified', $data);
        $this->assertStringStartsWith('2024-12-25T08:00:00', $data['dateModified']);
    }

    public function testSetDateCreatedWithString(): void
    {
        $metadata = (new Metadata())->setDateCreated('2024-01-01T00:00:00Z');
        $data = $metadata->jsonSerialize();

        $this->assertEquals('2024-01-01T00:00:00Z', $data['dateCreated']);
    }

    public function testSetDatePublishedWithString(): void
    {
        $metadata = (new Metadata())->setDatePublished('2024-06-01T12:00:00Z');
        $data = $metadata->jsonSerialize();

        $this->assertEquals('2024-06-01T12:00:00Z', $data['datePublished']);
    }

    public function testSetDatePublishedWithDateTimeImmutable(): void
    {
        $date = new DateTimeImmutable('2024-07-04T00:00:00+00:00');
        $metadata = (new Metadata())->setDatePublished($date);
        $data = $metadata->jsonSerialize();

        $this->assertArrayHasKey('datePublished', $data);
    }

    public function testTransparentToolbarFalse(): void
    {
        $metadata = (new Metadata())->setTransparentToolbar(false);
        $data = $metadata->jsonSerialize();

        $this->assertFalse($data['transparentToolbar']);
    }

    public function testMultipleLinkedArticles(): void
    {
        $metadata = (new Metadata())
            ->addLinkedArticle('https://example.com/article1', 'related')
            ->addLinkedArticle('https://example.com/article2', 'promoted');
        $data = $metadata->jsonSerialize();

        $this->assertCount(2, $data['links']);
        $this->assertEquals('related', $data['links'][0]['relationship']);
        $this->assertEquals('promoted', $data['links'][1]['relationship']);
    }
}

