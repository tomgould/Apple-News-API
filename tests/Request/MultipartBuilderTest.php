<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Request;

use TomGould\AppleNews\Request\MultipartBuilder;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

final class MultipartBuilderTest extends TestCase
{
    public function testBoundaryIsGenerated(): void
    {
        $builder = new MultipartBuilder();

        $boundary = $builder->getBoundary();

        $this->assertNotEmpty($boundary);
        $this->assertMatchesRegularExpression('/^[a-f0-9]{32}$/', $boundary);
    }

    public function testCustomBoundaryCanBeSet(): void
    {
        $customBoundary = 'my-custom-boundary-123';
        $builder = new MultipartBuilder($customBoundary);

        $this->assertEquals($customBoundary, $builder->getBoundary());
    }

    public function testGetContentTypeIncludesBoundary(): void
    {
        $builder = new MultipartBuilder('test-boundary');

        $contentType = $builder->getContentType();

        $this->assertEquals('multipart/form-data; boundary=test-boundary', $contentType);
    }

    public function testAddArticleCreatesJsonPart(): void
    {
        $builder = new MultipartBuilder('test-boundary');
        $json = '{"version":"1.24","identifier":"test"}';

        $builder->addArticle($json);
        $body = $builder->build();

        $this->assertStringContainsString('Content-Type: application/json', $body);
        $this->assertStringContainsString('filename=article.json', $body);
        $this->assertStringContainsString('name=article.json', $body);
        $this->assertStringContainsString($json, $body);
    }

    public function testAddMetadataWrapsInDataKey(): void
    {
        $builder = new MultipartBuilder('test-boundary');
        $metadata = ['isSponsored' => false];

        $builder->addMetadata($metadata);
        $body = $builder->build();

        $this->assertStringContainsString('"data":{"isSponsored":false}', $body);
        $this->assertStringContainsString('name=metadata', $body);
    }

    public function testAddJsonWithCustomName(): void
    {
        $builder = new MultipartBuilder('test-boundary');

        $builder->addJson('custom-part', '{"key":"value"}', 'custom.json');
        $body = $builder->build();

        $this->assertStringContainsString('name=custom-part', $body);
        $this->assertStringContainsString('filename=custom.json', $body);
    }

    public function testAddImageWithBinaryContent(): void
    {
        $builder = new MultipartBuilder('test-boundary');
        $fakeImageData = 'fake-binary-image-data';

        $builder->addImage('hero', $fakeImageData, 'hero.jpg');
        $body = $builder->build();

        $this->assertStringContainsString('Content-Type: image/jpeg', $body);
        $this->assertStringContainsString('filename=hero.jpg', $body);
        $this->assertStringContainsString('name=hero', $body);
        $this->assertStringContainsString($fakeImageData, $body);
    }

    public function testAddImageGuessesPngContentType(): void
    {
        $builder = new MultipartBuilder('test-boundary');

        $builder->addImage('logo', 'data', 'logo.png');
        $body = $builder->build();

        $this->assertStringContainsString('Content-Type: image/png', $body);
    }

    public function testAddImageGuessesGifContentType(): void
    {
        $builder = new MultipartBuilder('test-boundary');

        $builder->addImage('animation', 'data', 'animation.gif');
        $body = $builder->build();

        $this->assertStringContainsString('Content-Type: image/gif', $body);
    }

    public function testAddImageWithExplicitContentType(): void
    {
        $builder = new MultipartBuilder('test-boundary');

        $builder->addImage('webp', 'data', 'image.webp', 'image/webp');
        $body = $builder->build();

        $this->assertStringContainsString('Content-Type: image/webp', $body);
    }

    public function testAddFontUsesOctetStream(): void
    {
        $builder = new MultipartBuilder('test-boundary');

        $builder->addFont('custom-font', 'font-data', 'CustomFont.ttf');
        $body = $builder->build();

        $this->assertStringContainsString('Content-Type: application/octet-stream', $body);
        $this->assertStringContainsString('filename=CustomFont.ttf', $body);
    }

    public function testAddImageFileThrowsForMissingFile(): void
    {
        $builder = new MultipartBuilder();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Asset file not found');

        $builder->addImageFile('missing', '/nonexistent/path/image.jpg');
    }

    public function testBuildIncludesClosingBoundary(): void
    {
        $builder = new MultipartBuilder('test-boundary');
        $builder->addArticle('{}');

        $body = $builder->build();

        $this->assertStringEndsWith("--test-boundary--\r\n", $body);
    }

    public function testBuildWithMultipleParts(): void
    {
        $builder = new MultipartBuilder('test-boundary');

        $builder
            ->addArticle('{"version":"1.24"}')
            ->addMetadata(['isSponsored' => true])
            ->addImage('hero', 'image-data', 'hero.jpg');

        $body = $builder->build();

        // Count boundary occurrences (should be 4: 3 parts + closing)
        $this->assertEquals(4, substr_count($body, '--test-boundary'));

        // Verify all parts are present
        $this->assertStringContainsString('name=article.json', $body);
        $this->assertStringContainsString('name=metadata', $body);
        $this->assertStringContainsString('name=hero', $body);
    }

    public function testPartIncludesSizeHeader(): void
    {
        $builder = new MultipartBuilder('test-boundary');
        $content = '{"test":"data"}';

        $builder->addArticle($content);
        $body = $builder->build();

        $this->assertStringContainsString('size=' . strlen($content), $body);
    }

    public function testAddPartWithGenericContent(): void
    {
        $builder = new MultipartBuilder('test-boundary');

        $builder->addPart('custom', 'custom-content', 'text/plain', 'custom.txt');
        $body = $builder->build();

        $this->assertStringContainsString('Content-Type: text/plain', $body);
        $this->assertStringContainsString('name=custom', $body);
        $this->assertStringContainsString('filename=custom.txt', $body);
        $this->assertStringContainsString('custom-content', $body);
    }

    public function testUnknownExtensionUsesOctetStream(): void
    {
        $builder = new MultipartBuilder('test-boundary');

        $builder->addImage('file', 'data', 'file.xyz');
        $body = $builder->build();

        $this->assertStringContainsString('Content-Type: application/octet-stream', $body);
    }
}

