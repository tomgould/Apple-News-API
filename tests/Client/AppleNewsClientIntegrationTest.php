<?php

declare(strict_types=1);

namespace TomGould\AppleNews\Tests\Client;

use TomGould\AppleNews\Client\AppleNewsClient;
use TomGould\AppleNews\Document\Article;
use TomGould\AppleNews\Document\Components\Body;
use TomGould\AppleNews\Document\Components\Photo;
use TomGould\AppleNews\Document\Metadata;
use TomGould\AppleNews\Document\Styles\ComponentTextStyle;
use TomGould\AppleNews\Document\Styles\DocumentStyle;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Integration tests for AppleNewsClient covering asset handling and edge cases.
 */
final class AppleNewsClientIntegrationTest extends TestCase
{
    private ClientInterface $httpClient;
    private RequestFactoryInterface $requestFactory;
    private StreamFactoryInterface $streamFactory;
    private RequestInterface $request;
    private ResponseInterface $response;
    private StreamInterface $stream;
    private StreamInterface $bodyStream;
    private string $tempDir;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);
        $this->requestFactory = $this->createMock(RequestFactoryInterface::class);
        $this->streamFactory = $this->createMock(StreamFactoryInterface::class);
        $this->request = $this->createMock(RequestInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);
        $this->stream = $this->createMock(StreamInterface::class);
        $this->bodyStream = $this->createMock(StreamInterface::class);

        $this->request->method('withHeader')->willReturn($this->request);
        $this->request->method('withBody')->willReturn($this->request);

        $this->tempDir = sys_get_temp_dir() . '/apple-news-client-test-' . uniqid();
        mkdir($this->tempDir, 0777, true);
    }

    protected function tearDown(): void
    {
        $files = glob($this->tempDir . '/*');
        if ($files) {
            foreach ($files as $file) {
                unlink($file);
            }
        }
        rmdir($this->tempDir);
    }

    private function createClient(): AppleNewsClient
    {
        return AppleNewsClient::create(
            'test-key-id',
            'dGVzdC1zZWNyZXQ=',
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
        $this->streamFactory->method('createStream')->willReturn($this->bodyStream);
    }

    public function testCreateArticleWithFileAssets(): void
    {
        $imagePath = $this->tempDir . '/hero.jpg';
        file_put_contents($imagePath, 'fake-image-data');

        $this->mockSuccessResponse([
            'data' => ['id' => 'article-123'],
        ]);

        $client = $this->createClient();
        $article = Article::create('test', 'Test', 'en');
        $article->addComponent(Photo::fromBundle('hero.jpg'));

        $result = $client->createArticle(
            'channel-123',
            $article,
            null,
            ['bundle://hero.jpg' => $imagePath]
        );

        $this->assertEquals('article-123', $result['data']['id']);
    }

    public function testCreateArticleWithBinaryAssets(): void
    {
        $this->mockSuccessResponse([
            'data' => ['id' => 'article-123'],
        ]);

        $client = $this->createClient();
        $article = Article::create('test', 'Test', 'en');
        $article->addComponent(Photo::fromBundle('hero.jpg'));

        $result = $client->createArticle(
            'channel-123',
            $article,
            null,
            ['bundle://hero.jpg' => 'raw-binary-image-data']
        );

        $this->assertEquals('article-123', $result['data']['id']);
    }

    public function testCreateArticleFromJsonWithFileAssets(): void
    {
        $imagePath = $this->tempDir . '/hero.jpg';
        file_put_contents($imagePath, 'fake-image-data');

        $this->mockSuccessResponse([
            'data' => ['id' => 'article-123'],
        ]);

        $client = $this->createClient();
        $json = '{"version":"1.24","identifier":"test","title":"Test","language":"en","layout":{"columns":7,"width":1024},"components":[]}';

        $result = $client->createArticleFromJson(
            'channel-123',
            $json,
            ['isSponsored' => false],
            ['bundle://hero.jpg' => $imagePath]
        );

        $this->assertEquals('article-123', $result['data']['id']);
    }

    public function testCreateArticleFromJsonWithBinaryAssets(): void
    {
        $this->mockSuccessResponse([
            'data' => ['id' => 'article-123'],
        ]);

        $client = $this->createClient();
        $json = '{"version":"1.24","identifier":"test","title":"Test","language":"en","layout":{"columns":7,"width":1024},"components":[]}';

        $result = $client->createArticleFromJson(
            'channel-123',
            $json,
            null,
            ['bundle://hero.jpg' => 'binary-data']
        );

        $this->assertEquals('article-123', $result['data']['id']);
    }

    public function testUpdateArticleWithFileAssets(): void
    {
        $imagePath = $this->tempDir . '/updated.jpg';
        file_put_contents($imagePath, 'updated-image-data');

        $this->mockSuccessResponse([
            'data' => ['id' => 'article-123', 'revision' => 'rev-002'],
        ]);

        $client = $this->createClient();
        $article = Article::create('test', 'Updated', 'en');

        $result = $client->updateArticle(
            'article-123',
            'rev-001',
            $article,
            ['isSponsored' => true],
            ['bundle://updated.jpg' => $imagePath]
        );

        $this->assertEquals('rev-002', $result['data']['revision']);
    }

    public function testUpdateArticleWithBinaryAssets(): void
    {
        $this->mockSuccessResponse([
            'data' => ['id' => 'article-123', 'revision' => 'rev-002'],
        ]);

        $client = $this->createClient();
        $article = Article::create('test', 'Updated', 'en');

        $result = $client->updateArticle(
            'article-123',
            'rev-001',
            $article,
            null,
            ['bundle://image.png' => 'binary-png-data']
        );

        $this->assertEquals('rev-002', $result['data']['revision']);
    }

    public function testSearchArticlesInChannelWithEmptyParams(): void
    {
        $this->mockSuccessResponse([
            'data' => [['id' => 'article-1']],
        ]);

        $client = $this->createClient();
        $result = $client->searchArticlesInChannel('channel-123', []);

        $this->assertCount(1, $result['data']);
    }

    public function testSearchArticlesInSectionWithParams(): void
    {
        $this->mockSuccessResponse([
            'data' => [['id' => 'article-1']],
        ]);

        $client = $this->createClient();
        $result = $client->searchArticlesInSection('section-123', [
            'pageSize' => 20,
            'fromDate' => '2024-01-01',
        ]);

        $this->assertCount(1, $result['data']);
    }
}

