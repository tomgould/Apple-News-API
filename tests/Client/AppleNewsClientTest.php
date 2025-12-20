<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Client;

use TomGould\AppleNews\Client\AppleNewsClient;
use TomGould\AppleNews\Client\Authenticator;
use TomGould\AppleNews\Document\Article;
use TomGould\AppleNews\Exception\AppleNewsException;
use TomGould\AppleNews\Exception\AuthenticationException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

final class AppleNewsClientTest extends TestCase
{
    private ClientInterface $httpClient;
    private RequestFactoryInterface $requestFactory;
    private StreamFactoryInterface $streamFactory;
    private RequestInterface $request;
    private ResponseInterface $response;
    private StreamInterface $stream;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);
        $this->requestFactory = $this->createMock(RequestFactoryInterface::class);
        $this->streamFactory = $this->createMock(StreamFactoryInterface::class);
        $this->request = $this->createMock(RequestInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);
        $this->stream = $this->createMock(StreamInterface::class);

        // Default request mock behavior (fluent interface)
        $this->request->method('withHeader')->willReturn($this->request);
        $this->request->method('withBody')->willReturn($this->request);
    }

    private function createClient(): AppleNewsClient
    {
        return AppleNewsClient::create(
            'test-key-id',
            'dGVzdC1zZWNyZXQ=', // base64 encoded "test-secret"
            $this->httpClient,
            $this->requestFactory,
            $this->streamFactory
        );
    }

    private function mockSuccessResponse(array $data): void
    {
        $this->stream->method('getContents')->willReturn(json_encode($data));
        $this->response->method('getStatusCode')->willReturn(200);
        $this->response->method('getBody')->willReturn($this->stream);
        $this->httpClient->method('sendRequest')->willReturn($this->response);
        $this->requestFactory->method('createRequest')->willReturn($this->request);
    }

    private function mockErrorResponse(int $statusCode, array $data): void
    {
        $this->stream->method('getContents')->willReturn(json_encode($data));
        $this->response->method('getStatusCode')->willReturn($statusCode);
        $this->response->method('getBody')->willReturn($this->stream);
        $this->httpClient->method('sendRequest')->willReturn($this->response);
        $this->requestFactory->method('createRequest')->willReturn($this->request);
    }

    // ==========================================
    // Factory Method Tests
    // ==========================================

    public function testCreateReturnsClientInstance(): void
    {
        $client = $this->createClient();
        $this->assertInstanceOf(AppleNewsClient::class, $client);
    }

    // ==========================================
    // Channel Operations Tests
    // ==========================================

    public function testGetChannel(): void
    {
        $this->mockSuccessResponse([
            'data' => [
                'id' => 'channel-123',
                'name' => 'My Channel',
            ],
        ]);

        $client = $this->createClient();
        $result = $client->getChannel('channel-123');

        $this->assertEquals('channel-123', $result['data']['id']);
        $this->assertEquals('My Channel', $result['data']['name']);
    }

    public function testGetChannelQuota(): void
    {
        $this->mockSuccessResponse([
            'data' => [
                'quotaAvailable' => 1000,
                'quotaUsed' => 50,
            ],
        ]);

        $client = $this->createClient();
        $result = $client->getChannelQuota('channel-123');

        $this->assertEquals(1000, $result['data']['quotaAvailable']);
        $this->assertEquals(50, $result['data']['quotaUsed']);
    }

    // ==========================================
    // Section Operations Tests
    // ==========================================

    public function testListSections(): void
    {
        $this->mockSuccessResponse([
            'data' => [
                ['id' => 'section-1', 'name' => 'News'],
                ['id' => 'section-2', 'name' => 'Sports'],
            ],
        ]);

        $client = $this->createClient();
        $result = $client->listSections('channel-123');

        $this->assertCount(2, $result['data']);
        $this->assertEquals('section-1', $result['data'][0]['id']);
    }

    public function testGetSection(): void
    {
        $this->mockSuccessResponse([
            'data' => [
                'id' => 'section-123',
                'name' => 'Technology',
            ],
        ]);

        $client = $this->createClient();
        $result = $client->getSection('section-123');

        $this->assertEquals('Technology', $result['data']['name']);
    }

    public function testPromoteArticles(): void
    {
        $this->streamFactory->method('createStream')->willReturn($this->stream);
        $this->mockSuccessResponse([
            'data' => [
                'promotedArticles' => ['article-1', 'article-2'],
            ],
        ]);

        $client = $this->createClient();
        $result = $client->promoteArticles('section-123', ['article-1', 'article-2']);

        $this->assertEquals(['article-1', 'article-2'], $result['data']['promotedArticles']);
    }

    // ==========================================
    // Article Operations Tests
    // ==========================================

    public function testGetArticle(): void
    {
        $this->mockSuccessResponse([
            'data' => [
                'id' => 'article-123',
                'title' => 'Test Article',
                'revision' => 'rev-abc',
            ],
        ]);

        $client = $this->createClient();
        $result = $client->getArticle('article-123');

        $this->assertEquals('article-123', $result['data']['id']);
        $this->assertEquals('Test Article', $result['data']['title']);
        $this->assertEquals('rev-abc', $result['data']['revision']);
    }

    public function testSearchArticlesInChannel(): void
    {
        $this->mockSuccessResponse([
            'data' => [
                ['id' => 'article-1'],
                ['id' => 'article-2'],
            ],
        ]);

        $client = $this->createClient();
        $result = $client->searchArticlesInChannel('channel-123', ['pageSize' => 10]);

        $this->assertCount(2, $result['data']);
    }

    public function testSearchArticlesInSection(): void
    {
        $this->mockSuccessResponse([
            'data' => [
                ['id' => 'article-1'],
            ],
        ]);

        $client = $this->createClient();
        $result = $client->searchArticlesInSection('section-123');

        $this->assertCount(1, $result['data']);
    }

    public function testCreateArticle(): void
    {
        $this->streamFactory->method('createStream')->willReturn($this->stream);
        $this->mockSuccessResponse([
            'data' => [
                'id' => 'new-article-123',
                'revision' => 'rev-001',
                'shareUrl' => 'https://apple.news/abc123',
            ],
        ]);

        $client = $this->createClient();
        $article = Article::create('test-id', 'Test Title', 'en');
        $result = $client->createArticle('channel-123', $article);

        $this->assertEquals('new-article-123', $result['data']['id']);
        $this->assertEquals('https://apple.news/abc123', $result['data']['shareUrl']);
    }

    public function testCreateArticleWithMetadata(): void
    {
        $this->streamFactory->method('createStream')->willReturn($this->stream);
        $this->mockSuccessResponse([
            'data' => ['id' => 'article-123'],
        ]);

        $client = $this->createClient();
        $article = Article::create('test-id', 'Test Title', 'en');
        $result = $client->createArticle(
            'channel-123',
            $article,
            ['isSponsored' => true]
        );

        $this->assertArrayHasKey('data', $result);
    }

    public function testCreateArticleFromJson(): void
    {
        $this->streamFactory->method('createStream')->willReturn($this->stream);
        $this->mockSuccessResponse([
            'data' => ['id' => 'article-123'],
        ]);

        $client = $this->createClient();
        $json = '{"version":"1.24","identifier":"test","title":"Test","language":"en","layout":{"columns":7,"width":1024},"components":[]}';
        $result = $client->createArticleFromJson('channel-123', $json);

        $this->assertEquals('article-123', $result['data']['id']);
    }

    public function testUpdateArticle(): void
    {
        $this->streamFactory->method('createStream')->willReturn($this->stream);
        $this->mockSuccessResponse([
            'data' => [
                'id' => 'article-123',
                'revision' => 'rev-002',
            ],
        ]);

        $client = $this->createClient();
        $article = Article::create('test-id', 'Updated Title', 'en');
        $result = $client->updateArticle('article-123', 'rev-001', $article);

        $this->assertEquals('rev-002', $result['data']['revision']);
    }

    public function testDeleteArticle(): void
    {
        $this->stream->method('getContents')->willReturn('');
        $this->response->method('getStatusCode')->willReturn(204);
        $this->response->method('getBody')->willReturn($this->stream);
        $this->httpClient->method('sendRequest')->willReturn($this->response);
        $this->requestFactory->method('createRequest')->willReturn($this->request);

        $client = $this->createClient();

        // Should not throw
        $client->deleteArticle('article-123');
        $this->assertTrue(true);
    }

    // ==========================================
    // Error Handling Tests
    // ==========================================

    public function testAuthenticationError(): void
    {
        $this->mockErrorResponse(401, [
            'errors' => [
                [
                    'code' => 'UNAUTHORIZED',
                    'message' => 'Invalid API key',
                ],
            ],
        ]);

        $client = $this->createClient();

        $this->expectException(AuthenticationException::class);
        $this->expectExceptionMessage('Invalid API key');

        $client->getChannel('channel-123');
    }

    public function testForbiddenError(): void
    {
        $this->mockErrorResponse(403, [
            'errors' => [
                [
                    'code' => 'FORBIDDEN',
                    'message' => 'Access denied',
                ],
            ],
        ]);

        $client = $this->createClient();

        $this->expectException(AuthenticationException::class);

        $client->getChannel('channel-123');
    }

    public function testValidationError(): void
    {
        $this->mockErrorResponse(400, [
            'errors' => [
                [
                    'code' => 'INVALID_DOCUMENT',
                    'message' => 'The document is invalid',
                    'keyPath' => 'components[0]',
                ],
            ],
        ]);

        $client = $this->createClient();

        $this->expectException(AppleNewsException::class);
        $this->expectExceptionMessage('The document is invalid');

        $client->getArticle('article-123');
    }

    public function testRevisionConflictError(): void
    {
        $this->streamFactory->method('createStream')->willReturn($this->stream);
        $this->mockErrorResponse(409, [
            'errors' => [
                [
                    'code' => 'INVALID_REVISION',
                    'message' => 'The revision is outdated',
                ],
            ],
        ]);

        $client = $this->createClient();
        $article = Article::create('test', 'Test', 'en');

        try {
            $client->updateArticle('article-123', 'old-rev', $article);
            $this->fail('Expected exception not thrown');
        } catch (AppleNewsException $e) {
            $this->assertEquals('INVALID_REVISION', $e->getErrorCode());
            $this->assertEquals(409, $e->getCode());
        }
    }

    public function testInvalidJsonResponse(): void
    {
        $this->stream->method('getContents')->willReturn('not valid json');
        $this->response->method('getStatusCode')->willReturn(200);
        $this->response->method('getBody')->willReturn($this->stream);
        $this->httpClient->method('sendRequest')->willReturn($this->response);
        $this->requestFactory->method('createRequest')->willReturn($this->request);

        $client = $this->createClient();

        $this->expectException(AppleNewsException::class);
        $this->expectExceptionMessage('Invalid JSON response');

        $client->getChannel('channel-123');
    }

    public function testEmptyResponseReturnsEmptyArray(): void
    {
        $this->stream->method('getContents')->willReturn('');
        $this->response->method('getStatusCode')->willReturn(200);
        $this->response->method('getBody')->willReturn($this->stream);
        $this->httpClient->method('sendRequest')->willReturn($this->response);
        $this->requestFactory->method('createRequest')->willReturn($this->request);

        $client = $this->createClient();
        $result = $client->getChannel('channel-123');

        $this->assertEquals([], $result);
    }

    public function testPlainTextErrorResponse(): void
    {
        $this->stream->method('getContents')->willReturn('Internal Server Error');
        $this->response->method('getStatusCode')->willReturn(500);
        $this->response->method('getBody')->willReturn($this->stream);
        $this->httpClient->method('sendRequest')->willReturn($this->response);
        $this->requestFactory->method('createRequest')->willReturn($this->request);

        $client = $this->createClient();

        $this->expectException(AppleNewsException::class);
        $this->expectExceptionMessage('HTTP 500: Internal Server Error');

        $client->getChannel('channel-123');
    }
}
