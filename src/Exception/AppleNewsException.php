<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Exception;

use Exception;
use Throwable;

/**
 * Base exception for all Apple News API errors.
 */
class AppleNewsException extends Exception
{
    protected ?string $errorCode = null;
    protected ?string $keyPath = null;

    public function __construct(
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null,
        ?string $errorCode = null,
        ?string $keyPath = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->errorCode = $errorCode;
        $this->keyPath = $keyPath;
    }

    /**
     * Get the Apple News API error code.
     */
    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }

    /**
     * Get the key path where the error occurred.
     */
    public function getKeyPath(): ?string
    {
        return $this->keyPath;
    }

    /**
     * Create an exception from an API error response.
     *
     * @param array<string, mixed> $response
     */
    public static function fromResponse(array $response, int $httpCode = 0): self
    {
        $errors = $response['errors'] ?? [];
        $firstError = $errors[0] ?? [];

        $message = $firstError['message'] ?? $response['message'] ?? 'Unknown Apple News API error';
        $errorCode = $firstError['code'] ?? null;
        $keyPath = $firstError['keyPath'] ?? null;

        return new self($message, $httpCode, null, $errorCode, $keyPath);
    }
}
