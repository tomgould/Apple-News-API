<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Client;

use TomGould\AppleNews\Client\Authenticator;
use PHPUnit\Framework\TestCase;
use DateTimeImmutable;
use DateTimeZone;
use InvalidArgumentException;

/**
 * Additional Authenticator tests for full coverage.
 */
final class AuthenticatorFullTest extends TestCase
{
    private const TEST_KEY_ID = 'test-key-id';
    private const TEST_KEY_SECRET = 'dGVzdC1zZWNyZXQta2V5LWhlcmU='; // base64 encoded

    public function testSignWithCustomDate(): void
    {
        $authenticator = new Authenticator(self::TEST_KEY_ID, self::TEST_KEY_SECRET);
        $customDate = new DateTimeImmutable('2024-06-15T10:30:00Z', new DateTimeZone('UTC'));

        $result = $authenticator->sign(
            'GET',
            'https://news-api.apple.com/channels/test',
            null,
            null,
            $customDate
        );

        $this->assertEquals('2024-06-15T10:30:00Z', $result['date']);
        $this->assertStringContainsString('date=2024-06-15T10:30:00Z', $result['authorization']);
    }

    public function testSignDeleteRequest(): void
    {
        $authenticator = new Authenticator(self::TEST_KEY_ID, self::TEST_KEY_SECRET);

        $result = $authenticator->sign(
            'DELETE',
            'https://news-api.apple.com/articles/article-123'
        );

        $this->assertArrayHasKey('authorization', $result);
        $this->assertStringStartsWith('HHMAC;', $result['authorization']);
    }

    public function testSignPostWithoutBody(): void
    {
        $authenticator = new Authenticator(self::TEST_KEY_ID, self::TEST_KEY_SECRET);

        $result = $authenticator->sign(
            'POST',
            'https://news-api.apple.com/channels/test/articles'
        );

        $this->assertArrayHasKey('authorization', $result);
    }

    public function testSignPostWithContentTypeButNoBody(): void
    {
        $authenticator = new Authenticator(self::TEST_KEY_ID, self::TEST_KEY_SECRET);

        $result = $authenticator->sign(
            'POST',
            'https://news-api.apple.com/channels/test/articles',
            'application/json',
            null
        );

        $this->assertArrayHasKey('authorization', $result);
    }

    public function testSignPostWithBodyButNoContentType(): void
    {
        $authenticator = new Authenticator(self::TEST_KEY_ID, self::TEST_KEY_SECRET);

        $result = $authenticator->sign(
            'POST',
            'https://news-api.apple.com/channels/test/articles',
            null,
            '{"data":"test"}'
        );

        $this->assertArrayHasKey('authorization', $result);
    }

    public function testSignWithMultipartContentType(): void
    {
        $authenticator = new Authenticator(self::TEST_KEY_ID, self::TEST_KEY_SECRET);
        $body = '--boundary\r\nContent-Type: application/json\r\n\r\n{}';
        $contentType = 'multipart/form-data; boundary=boundary';

        $result = $authenticator->sign(
            'POST',
            'https://news-api.apple.com/channels/test/articles',
            $contentType,
            $body
        );

        $this->assertArrayHasKey('authorization', $result);
    }

    public function testSignatureChangesWithDifferentUrls(): void
    {
        $authenticator = new Authenticator(self::TEST_KEY_ID, self::TEST_KEY_SECRET);
        $fixedDate = new DateTimeImmutable('2024-01-01T00:00:00Z');

        $result1 = $authenticator->sign('GET', 'https://news-api.apple.com/channels/a', null, null, $fixedDate);
        $result2 = $authenticator->sign('GET', 'https://news-api.apple.com/channels/b', null, null, $fixedDate);

        $this->assertNotEquals($result1['authorization'], $result2['authorization']);
    }

    public function testSignatureChangesWithDifferentMethods(): void
    {
        $authenticator = new Authenticator(self::TEST_KEY_ID, self::TEST_KEY_SECRET);
        $fixedDate = new DateTimeImmutable('2024-01-01T00:00:00Z');
        $url = 'https://news-api.apple.com/articles/123';

        $resultGet = $authenticator->sign('GET', $url, null, null, $fixedDate);
        $resultDelete = $authenticator->sign('DELETE', $url, null, null, $fixedDate);

        $this->assertNotEquals($resultGet['authorization'], $resultDelete['authorization']);
    }

    public function testSignatureChangesWithDifferentDates(): void
    {
        $authenticator = new Authenticator(self::TEST_KEY_ID, self::TEST_KEY_SECRET);
        $url = 'https://news-api.apple.com/channels/test';

        $date1 = new DateTimeImmutable('2024-01-01T00:00:00Z');
        $date2 = new DateTimeImmutable('2024-01-01T00:00:01Z');

        $result1 = $authenticator->sign('GET', $url, null, null, $date1);
        $result2 = $authenticator->sign('GET', $url, null, null, $date2);

        $this->assertNotEquals($result1['authorization'], $result2['authorization']);
    }

    public function testInvalidBase64SecretThrowsException(): void
    {
        $authenticator = new Authenticator(self::TEST_KEY_ID, '!!!invalid-base64!!!');

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid Base64-encoded API secret');

        $authenticator->sign('GET', 'https://news-api.apple.com/channels/test');
    }

    public function testMethodIsCaseInsensitive(): void
    {
        $authenticator = new Authenticator(self::TEST_KEY_ID, self::TEST_KEY_SECRET);
        $fixedDate = new DateTimeImmutable('2024-01-01T00:00:00Z');
        $url = 'https://news-api.apple.com/channels/test';

        $resultLower = $authenticator->sign('get', $url, null, null, $fixedDate);
        $resultUpper = $authenticator->sign('GET', $url, null, null, $fixedDate);

        // Should produce the same signature since method is uppercased
        $this->assertEquals($resultLower['authorization'], $resultUpper['authorization']);
    }
}
