<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Client;

use TomGould\AppleNews\Document\Article;
use TomGould\AppleNews\Exception\AppleNewsException;
use TomGould\AppleNews\Exception\AuthenticationException;
use TomGould\AppleNews\Request\MultipartBuilder;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Apple News Publisher API Client.
 *
 * Provides methods for interacting with the Apple News API:
 * - Channel information
 * - Section management
 * - Article CRUD operations
 *
 * @see https://developer.apple.com/documentation/apple_news/apple_news_api
 */
final class AppleNewsClient
{
    private const API_ENDPOINT = 'https://news-api.apple.com';

    public function __construct(
        private readonly Authenticator $authenticator,
        private readonly ClientInterface $httpClient,
        private readonly RequestFactoryInterface $requestFactory,
        private readonly StreamFactoryInterface $streamFactory,
        private readonly string $endpoint = self::API_ENDPOINT
    ) {
    }

    /**
     * Create a client with the given credentials.
     */
    public static function create(
        string $keyId,
        string $keySecret,
        ClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        string $endpoint = self::API_ENDPOINT
    ): self {
        return new self(
            new Authenticator($keyId, $keySecret),
            $httpClient,
            $requestFactory,
            $streamFactory,
            $endpoint
        );
    }

    // ========================================
    // Channel Operations
    // ========================================

    /**
     * Get channel information.
     *
     * @return array<string, mixed>
     * @throws AppleNewsException
     */
    public function getChannel(string $channelId): array
    {
        return $this->get("/channels/{$channelId}");
    }

    /**
     * Get channel quota information.
     *
     * @return array<string, mixed>
     * @throws AppleNewsException
     */
    public function getChannelQuota(string $channelId): array
    {
        return $this->get("/channels/{$channelId}/quota");
    }

    // ========================================
    // Section Operations
    // ========================================

    /**
     * List all sections in a channel.
     *
     * @return array<string, mixed>
     * @throws AppleNewsException
     */
    public function listSections(string $channelId): array
    {
        return $this->get("/channels/{$channelId}/sections");
    }

    /**
     * Get section information.
     *
     * @return array<string, mixed>
     * @throws AppleNewsException
     */
    public function getSection(string $sectionId): array
    {
        return $this->get("/sections/{$sectionId}");
    }

    /**
     * Promote articles in a section.
     *
     * @param array<string> $articleIds
     * @return array<string, mixed>
     * @throws AppleNewsException
     */
    public function promoteArticles(string $sectionId, array $articleIds): array
    {
        $body = json_encode([
            'data' => [
                'promotedArticles' => $articleIds,
            ],
        ], JSON_THROW_ON_ERROR);

        return $this->postJson("/sections/{$sectionId}/promotedArticles", $body);
    }

    // ========================================
    // Article Operations
    // ========================================

    /**
     * Create a new article.
     *
     * @param array<string, mixed>|null $metadata Optional metadata (sections, isSponsored, etc.)
     * @param array<string, string> $assets Map of bundle:// URLs to file paths or content
     * @return array<string, mixed>
     * @throws AppleNewsException
     */
    public function createArticle(
        string $channelId,
        Article $article,
        ?array $metadata = null,
        array $assets = []
    ): array {
        $builder = new MultipartBuilder();
        $builder->addArticle($article->toJson());

        if ($metadata !== null) {
            $builder->addMetadata($metadata);
        }

        foreach ($assets as $bundleUrl => $asset) {
            $filename = str_replace('bundle://', '', $bundleUrl);
            if (file_exists($asset)) {
                $builder->addImageFile($filename, $asset);
            } else {
                // Assume it's binary content
                $builder->addImage($filename, $asset, $filename);
            }
        }

        return $this->postMultipart("/channels/{$channelId}/articles", $builder);
    }

    /**
     * Create an article from raw JSON.
     *
     * @param array<string, mixed>|null $metadata
     * @param array<string, string> $assets
     * @return array<string, mixed>
     * @throws AppleNewsException
     */
    public function createArticleFromJson(
        string $channelId,
        string $articleJson,
        ?array $metadata = null,
        array $assets = []
    ): array {
        $builder = new MultipartBuilder();
        $builder->addArticle($articleJson);

        if ($metadata !== null) {
            $builder->addMetadata($metadata);
        }

        foreach ($assets as $bundleUrl => $asset) {
            $filename = str_replace('bundle://', '', $bundleUrl);
            if (file_exists($asset)) {
                $builder->addImageFile($filename, $asset);
            } else {
                $builder->addImage($filename, $asset, $filename);
            }
        }

        return $this->postMultipart("/channels/{$channelId}/articles", $builder);
    }

    /**
     * Get article information.
     *
     * @return array<string, mixed>
     * @throws AppleNewsException
     */
    public function getArticle(string $articleId): array
    {
        return $this->get("/articles/{$articleId}");
    }

    /**
     * Search articles in a channel.
     *
     * @param array<string, mixed> $params Search parameters (pageSize, pageToken, fromDate, toDate, etc.)
     * @return array<string, mixed>
     * @throws AppleNewsException
     */
    public function searchArticlesInChannel(string $channelId, array $params = []): array
    {
        $query = http_build_query($params);
        $path = "/channels/{$channelId}/articles";
        if ($query !== '') {
            $path .= '?' . $query;
        }

        return $this->get($path);
    }

    /**
     * Search articles in a section.
     *
     * @param array<string, mixed> $params
     * @return array<string, mixed>
     * @throws AppleNewsException
     */
    public function searchArticlesInSection(string $sectionId, array $params = []): array
    {
        $query = http_build_query($params);
        $path = "/sections/{$sectionId}/articles";
        if ($query !== '') {
            $path .= '?' . $query;
        }

        return $this->get($path);
    }

    /**
     * Update an existing article.
     *
     * @param array<string, mixed>|null $metadata
     * @param array<string, string> $assets
     * @return array<string, mixed>
     * @throws AppleNewsException
     */
    public function updateArticle(
        string $articleId,
        string $revision,
        Article $article,
        ?array $metadata = null,
        array $assets = []
    ): array {
        $builder = new MultipartBuilder();
        $builder->addArticle($article->toJson());

        // Revision is required for updates
        $meta = $metadata ?? [];
        $meta['revision'] = $revision;
        $builder->addMetadata($meta);

        foreach ($assets as $bundleUrl => $asset) {
            $filename = str_replace('bundle://', '', $bundleUrl);
            if (file_exists($asset)) {
                $builder->addImageFile($filename, $asset);
            } else {
                $builder->addImage($filename, $asset, $filename);
            }
        }

        return $this->postMultipart("/articles/{$articleId}", $builder);
    }

    /**
     * Delete an article.
     *
     * @throws AppleNewsException
     */
    public function deleteArticle(string $articleId): void
    {
        $this->delete("/articles/{$articleId}");
    }

    // ========================================
    // HTTP Methods
    // ========================================

    /**
     * Perform a GET request.
     *
     * @return array<string, mixed>
     * @throws AppleNewsException
     */
    private function get(string $path): array
    {
        $url = $this->endpoint . $path;
        $auth = $this->authenticator->sign('GET', $url);

        $request = $this->requestFactory
            ->createRequest('GET', $url)
            ->withHeader('Authorization', $auth['authorization'])
            ->withHeader('Accept', 'application/json');

        return $this->sendRequest($request);
    }

    /**
     * Perform a POST request with JSON body.
     *
     * @return array<string, mixed>
     * @throws AppleNewsException
     */
    private function postJson(string $path, string $body): array
    {
        $url = $this->endpoint . $path;
        $contentType = 'application/json';
        $auth = $this->authenticator->sign('POST', $url, $contentType, $body);

        $request = $this->requestFactory
            ->createRequest('POST', $url)
            ->withHeader('Authorization', $auth['authorization'])
            ->withHeader('Content-Type', $contentType)
            ->withHeader('Accept', 'application/json')
            ->withBody($this->streamFactory->createStream($body));

        return $this->sendRequest($request);
    }

    /**
     * Perform a POST request with multipart body.
     *
     * @return array<string, mixed>
     * @throws AppleNewsException
     */
    private function postMultipart(string $path, MultipartBuilder $builder): array
    {
        $url = $this->endpoint . $path;
        $body = $builder->build();
        $contentType = $builder->getContentType();
        $auth = $this->authenticator->sign('POST', $url, $contentType, $body);

        $request = $this->requestFactory
            ->createRequest('POST', $url)
            ->withHeader('Authorization', $auth['authorization'])
            ->withHeader('Content-Type', $contentType)
            ->withHeader('Accept', 'application/json')
            ->withBody($this->streamFactory->createStream($body));

        return $this->sendRequest($request);
    }

    /**
     * Perform a DELETE request.
     *
     * @throws AppleNewsException
     */
    private function delete(string $path): void
    {
        $url = $this->endpoint . $path;
        $auth = $this->authenticator->sign('DELETE', $url);

        $request = $this->requestFactory
            ->createRequest('DELETE', $url)
            ->withHeader('Authorization', $auth['authorization']);

        $response = $this->httpClient->sendRequest($request);
        $statusCode = $response->getStatusCode();

        if ($statusCode < 200 || $statusCode >= 300) {
            $this->handleErrorResponse($response->getBody()->getContents(), $statusCode);
        }
    }

    /**
     * Send a request and decode the JSON response.
     *
     * @return array<string, mixed>
     * @throws AppleNewsException
     */
    private function sendRequest(\Psr\Http\Message\RequestInterface $request): array
    {
        $response = $this->httpClient->sendRequest($request);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        if ($statusCode < 200 || $statusCode >= 300) {
            $this->handleErrorResponse($body, $statusCode);
        }

        if ($body === '') {
            return [];
        }

        try {
            return json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new AppleNewsException('Invalid JSON response from API', $statusCode, $e);
        }
    }

    /**
     * Handle error responses from the API.
     *
     * @throws AppleNewsException
     */
    private function handleErrorResponse(string $body, int $statusCode): never
    {
        try {
            $data = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            throw new AppleNewsException("HTTP {$statusCode}: {$body}", $statusCode);
        }

        if ($statusCode === 401 || $statusCode === 403) {
            throw new AuthenticationException(
                $data['errors'][0]['message'] ?? 'Authentication failed',
                $statusCode,
                null,
                $data['errors'][0]['code'] ?? null
            );
        }

        throw AppleNewsException::fromResponse($data, $statusCode);
    }
}
