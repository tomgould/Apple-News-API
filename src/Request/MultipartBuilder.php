<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Request;

/**
 * Builds multipart/form-data request bodies for Apple News API.
 *
 * Apple News requires articles to be submitted as MIME multipart messages
 * containing at least article.json, plus any bundled resources.
 */
final class MultipartBuilder
{
    private const CRLF = "\r\n";

    private string $boundary;

    /** @var array<int, array{name: string, filename: string|null, contentType: string, content: string}> */
    private array $parts = [];

    public function __construct(?string $boundary = null)
    {
        $this->boundary = $boundary ?? bin2hex(random_bytes(16));
    }

    /**
     * Add a JSON part (article.json or metadata).
     */
    public function addJson(string $name, string $json, ?string $filename = null): self
    {
        return $this->addPart($name, $json, 'application/json', $filename ?? $name);
    }

    /**
     * Add the article.json document.
     */
    public function addArticle(string $json): self
    {
        return $this->addJson('article.json', $json, 'article.json');
    }

    /**
     * Add article metadata.
     *
     * @param array<string, mixed> $metadata
     */
    public function addMetadata(array $metadata): self
    {
        return $this->addJson('metadata', json_encode(['data' => $metadata], JSON_THROW_ON_ERROR));
    }

    /**
     * Add an image from file path.
     */
    public function addImageFile(string $name, string $filePath): self
    {
        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException("File not found: {$filePath}");
        }

        $content = file_get_contents($filePath);
        if ($content === false) {
            throw new \RuntimeException("Failed to read file: {$filePath}");
        }

        $contentType = $this->guessImageContentType($filePath);
        $filename = basename($filePath);

        return $this->addPart($name, $content, $contentType, $filename);
    }

    /**
     * Add an image from binary content.
     */
    public function addImage(string $name, string $content, string $filename, ?string $contentType = null): self
    {
        $contentType ??= $this->guessImageContentType($filename);
        return $this->addPart($name, $content, $contentType, $filename);
    }

    /**
     * Add a font file.
     */
    public function addFont(string $name, string $content, string $filename): self
    {
        return $this->addPart($name, $content, 'application/octet-stream', $filename);
    }

    /**
     * Add a generic part to the multipart body.
     */
    public function addPart(string $name, string $content, string $contentType, ?string $filename = null): self
    {
        $this->parts[] = [
            'name' => $name,
            'filename' => $filename,
            'contentType' => $contentType,
            'content' => $content,
        ];

        return $this;
    }

    /**
     * Build the complete multipart body.
     */
    public function build(): string
    {
        $body = '';

        foreach ($this->parts as $part) {
            $body .= '--' . $this->boundary . self::CRLF;
            $body .= 'Content-Type: ' . $part['contentType'] . self::CRLF;

            $disposition = 'Content-Disposition: form-data';
            if ($part['filename'] !== null) {
                $disposition .= '; filename=' . $part['filename'];
            }
            $disposition .= '; name=' . $part['name'];
            $disposition .= '; size=' . strlen($part['content']);

            $body .= $disposition . self::CRLF;
            $body .= self::CRLF;
            $body .= $part['content'] . self::CRLF;
        }

        $body .= '--' . $this->boundary . '--' . self::CRLF;

        return $body;
    }

    /**
     * Get the Content-Type header value.
     */
    public function getContentType(): string
    {
        return 'multipart/form-data; boundary=' . $this->boundary;
    }

    /**
     * Get the boundary string.
     */
    public function getBoundary(): string
    {
        return $this->boundary;
    }

    /**
     * Guess the image content type from filename.
     */
    private function guessImageContentType(string $filename): string
    {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        return match ($extension) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            default => 'application/octet-stream',
        };
    }
}
