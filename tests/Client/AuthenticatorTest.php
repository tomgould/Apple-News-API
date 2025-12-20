<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Client;

use TomGould\AppleNews\Client\Authenticator;
use PHPUnit\Framework\TestCase;

final class AuthenticatorTest extends TestCase
{
    private const TEST_KEY_ID = 'test-key-id';
    private const TEST_KEY_SECRET = 'dGVzdC1zZWNyZXQta2V5LWhlcmU='; // base64 encoded

    public function testSignGeneratesValidAuthorizationHeader(): void
    {
        $authenticator = new Authenticator(self::TEST_KEY_ID, self::TEST_KEY_SECRET);

        $result = $authenticator->sign(
            'GET',
            'https://news-api.apple.com/channels/test-channel'
        );

        $this->assertArrayHasKey('authorization', $result);
        $this->assertArrayHasKey('date', $result);

        // Check authorization header format
        $this->assertStringStartsWith('HHMAC; key=', $result['authorization']);
        $this->assertStringContainsString('signature=', $result['authorization']);
        $this->assertStringContainsString('date=', $result['authorization']);
    }

    public function testSignIncludesKeyId(): void
    {
        $authenticator = new Authenticator(self::TEST_KEY_ID, self::TEST_KEY_SECRET);

        $result = $authenticator->sign(
            'GET',
            'https://news-api.apple.com/channels/test-channel'
        );

        $this->assertStringContainsString('key=' . self::TEST_KEY_ID, $result['authorization']);
    }

    public function testSignWithPostIncludesContentType(): void
    {
        $authenticator = new Authenticator(self::TEST_KEY_ID, self::TEST_KEY_SECRET);

        $body = '{"test": "data"}';
        $contentType = 'application/json';

        $resultWithBody = $authenticator->sign(
            'POST',
            'https://news-api.apple.com/channels/test-channel/articles',
            $contentType,
            $body
        );

        $resultWithoutBody = $authenticator->sign(
            'POST',
            'https://news-api.apple.com/channels/test-channel/articles'
        );

        // Signatures should be different when body is included
        $this->assertNotEquals(
            $resultWithBody['authorization'],
            $resultWithoutBody['authorization']
        );
    }

    public function testGetKeyIdReturnsKeyId(): void
    {
        $authenticator = new Authenticator(self::TEST_KEY_ID, self::TEST_KEY_SECRET);

        $this->assertEquals(self::TEST_KEY_ID, $authenticator->getKeyId());
    }

    public function testDateFormatIsISO8601(): void
    {
        $authenticator = new Authenticator(self::TEST_KEY_ID, self::TEST_KEY_SECRET);

        $result = $authenticator->sign(
            'GET',
            'https://news-api.apple.com/channels/test-channel'
        );

        // Date should match ISO 8601 format: 2024-01-15T12:00:00Z
        $this->assertMatchesRegularExpression(
            '/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/',
            $result['date']
        );
    }
}
