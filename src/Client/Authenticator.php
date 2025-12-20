<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Client;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;

/**
 * Handles HMAC-SHA256 authentication for Apple News API requests.
 *
 * Apple News uses a custom HMAC authentication scheme where requests are signed
 * using the API secret key. The signature is computed from:
 * - HTTP method (uppercase)
 * - Full request URL
 * - ISO 8601 date
 * - For POST requests: Content-Type header + request body
 */
final class Authenticator
{
    private const DATE_FORMAT = 'Y-m-d\TH:i:s\Z';
    private const HASH_ALGORITHM = 'sha256';

    public function __construct(
        private readonly string $keyId,
        private readonly string $keySecret
    ) {
    }

    /**
     * Generate the Authorization header value for a request.
     *
     * @param string $method HTTP method (GET, POST, DELETE)
     * @param string $url Full request URL
     * @param string|null $contentType Content-Type header (required for POST)
     * @param string|null $body Request body (required for POST)
     * @param DateTimeInterface|null $date Date for the signature (defaults to now)
     *
     * @return array{authorization: string, date: string}
     */
    public function sign(
        string $method,
        string $url,
        ?string $contentType = null,
        ?string $body = null,
        ?DateTimeInterface $date = null
    ): array {
        $date ??= new DateTimeImmutable('now', new DateTimeZone('UTC'));
        $dateString = $date->format(self::DATE_FORMAT);

        $canonicalRequest = $this->buildCanonicalRequest(
            strtoupper($method),
            $url,
            $dateString,
            $contentType,
            $body
        );

        $signature = $this->createSignature($canonicalRequest);

        return [
            'authorization' => sprintf(
                'HHMAC; key=%s; signature=%s; date=%s',
                $this->keyId,
                $signature,
                $dateString
            ),
            'date' => $dateString,
        ];
    }

    /**
     * Build the canonical request string for HMAC signing.
     *
     * For GET/DELETE: METHOD + URL + DATE
     * For POST: METHOD + URL + DATE + CONTENT_TYPE + BODY
     */
    private function buildCanonicalRequest(
        string $method,
        string $url,
        string $date,
        ?string $contentType,
        ?string $body
    ): string {
        $canonical = $method . $url . $date;

        // POST requests include Content-Type and body
        if ($method === 'POST' && $contentType !== null && $body !== null) {
            $canonical .= $contentType . $body;
        }

        return $canonical;
    }

    /**
     * Create the HMAC-SHA256 signature.
     *
     * 1. Base64 decode the secret key
     * 2. HMAC-SHA256 hash the canonical request
     * 3. Base64 encode the result
     */
    private function createSignature(string $canonicalRequest): string
    {
        // The API secret is provided as a Base64-encoded string
        $decodedSecret = base64_decode($this->keySecret, true);

        if ($decodedSecret === false) {
            throw new \InvalidArgumentException('Invalid Base64-encoded API secret');
        }

        $hash = hash_hmac(self::HASH_ALGORITHM, $canonicalRequest, $decodedSecret, true);

        return base64_encode($hash);
    }

    /**
     * Get the API Key ID.
     */
    public function getKeyId(): string
    {
        return $this->keyId;
    }
}
