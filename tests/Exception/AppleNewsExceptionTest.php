<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Exception;

use TomGould\AppleNews\Exception\AppleNewsException;
use TomGould\AppleNews\Exception\AuthenticationException;
use PHPUnit\Framework\TestCase;

final class AppleNewsExceptionTest extends TestCase
{
    public function testBasicExceptionProperties(): void
    {
        $exception = new AppleNewsException(
            'Something went wrong',
            400,
            null,
            'INVALID_REQUEST',
            'components[0].text'
        );

        $this->assertEquals('Something went wrong', $exception->getMessage());
        $this->assertEquals(400, $exception->getCode());
        $this->assertEquals('INVALID_REQUEST', $exception->getErrorCode());
        $this->assertEquals('components[0].text', $exception->getKeyPath());
    }

    public function testFromResponseWithSingleError(): void
    {
        $response = [
            'errors' => [
                [
                    'code' => 'INVALID_REVISION',
                    'message' => 'The revision token is invalid.',
                    'keyPath' => 'metadata.revision',
                ],
            ],
        ];

        $exception = AppleNewsException::fromResponse($response, 409);

        $this->assertEquals('The revision token is invalid.', $exception->getMessage());
        $this->assertEquals(409, $exception->getCode());
        $this->assertEquals('INVALID_REVISION', $exception->getErrorCode());
        $this->assertEquals('metadata.revision', $exception->getKeyPath());
    }

    public function testFromResponseWithMultipleErrors(): void
    {
        $response = [
            'errors' => [
                [
                    'code' => 'FIRST_ERROR',
                    'message' => 'First error message',
                ],
                [
                    'code' => 'SECOND_ERROR',
                    'message' => 'Second error message',
                ],
            ],
        ];

        $exception = AppleNewsException::fromResponse($response, 400);

        // Should use the first error
        $this->assertEquals('First error message', $exception->getMessage());
        $this->assertEquals('FIRST_ERROR', $exception->getErrorCode());
    }

    public function testFromResponseWithTopLevelMessage(): void
    {
        $response = [
            'message' => 'Top level error message',
        ];

        $exception = AppleNewsException::fromResponse($response, 500);

        $this->assertEquals('Top level error message', $exception->getMessage());
        $this->assertNull($exception->getErrorCode());
    }

    public function testFromResponseWithEmptyResponse(): void
    {
        $exception = AppleNewsException::fromResponse([], 500);

        $this->assertEquals('Unknown Apple News API error', $exception->getMessage());
        $this->assertNull($exception->getErrorCode());
        $this->assertNull($exception->getKeyPath());
    }

    public function testFromResponseWithPartialError(): void
    {
        $response = [
            'errors' => [
                [
                    'message' => 'Only message, no code',
                ],
            ],
        ];

        $exception = AppleNewsException::fromResponse($response, 400);

        $this->assertEquals('Only message, no code', $exception->getMessage());
        $this->assertNull($exception->getErrorCode());
    }

    public function testAuthenticationExceptionExtendsBase(): void
    {
        $exception = new AuthenticationException(
            'Invalid API key',
            401,
            null,
            'UNAUTHORIZED'
        );

        $this->assertInstanceOf(AppleNewsException::class, $exception);
        $this->assertEquals('Invalid API key', $exception->getMessage());
        $this->assertEquals(401, $exception->getCode());
        $this->assertEquals('UNAUTHORIZED', $exception->getErrorCode());
    }

    public function testExceptionChaining(): void
    {
        $previous = new \RuntimeException('Original error');
        $exception = new AppleNewsException('Wrapped error', 500, $previous);

        $this->assertSame($previous, $exception->getPrevious());
    }
}

