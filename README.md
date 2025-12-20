# Apple News API PHP Client

A modern, PSR-compliant PHP library for the Apple News Publisher API with full Apple News Format document support.

[![PHP Version](https://img.shields.io/badge/php-%5E8.1-blue)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)

## Features

- 🚀 **Modern PHP 8.1+** with strict types and named arguments
- 🔌 **PSR-18 HTTP Client** compatible (use Guzzle, Symfony HTTP Client, or any PSR-18 client)
- 📝 **Full Apple News Format** support with fluent document builder
- 🔐 **HMAC-SHA256 authentication** handled automatically
- 📦 **Zero framework dependencies** - works with any PHP application
- ✅ **Fully tested** with PHPUnit

## Installation

```bash
composer require tomgould/apple-news-api
```

You'll also need a PSR-18 HTTP client. We recommend Guzzle:

```bash
composer require guzzlehttp/guzzle guzzlehttp/psr7
```

## Quick Start

### 1. Create the Client

```php
use TomGould\AppleNews\Client\AppleNewsClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;

$httpClient = new Client();
$factory = new HttpFactory();

$client = AppleNewsClient::create(
    keyId: 'your-api-key-id',
    keySecret: 'your-api-secret',  // Base64-encoded
    httpClient: $httpClient,
    requestFactory: $factory,
    streamFactory: $factory
);
```

### 2. Create an Article

```php
use TomGould\AppleNews\Document\Article;
use TomGould\AppleNews\Document\Metadata;
use TomGould\AppleNews\Document\Components\{Title, Body, Photo};
use TomGould\AppleNews\Document\Styles\{DocumentStyle, ComponentTextStyle};

// Create the article
$article = Article::create(
    identifier: 'my-article-123',
    title: 'My First Article',
    language: 'en'
);

// Add components
$article
    ->addComponent(new Title('Welcome to Apple News'))
    ->addComponent(
        (new Body('This is the article body with <strong>HTML</strong> support.'))
            ->setFormat('html')
            ->setTextStyle('bodyStyle')
    )
    ->addComponent(
        Photo::fromUrl('https://example.com/image.jpg')
            ->setCaption('A beautiful image')
    );

// Add metadata
$metadata = (new Metadata())
    ->setCanonicalURL('https://example.com/article')
    ->setDatePublished(new DateTime())
    ->addAuthor('John Doe')
    ->addKeywords(['news', 'technology']);

$article->setMetadata($metadata);

// Add text styles
$article->addComponentTextStyle(
    'bodyStyle',
    (new ComponentTextStyle())
        ->setFontName('Georgia')
        ->setFontSize(18)
        ->setLineHeight(28)
);

// Set document style
$article->setDocumentStyle(
    (new DocumentStyle())->setBackgroundColor('#FFFFFF')
);
```

### 3. Publish the Article

```php
$response = $client->createArticle(
    channelId: 'your-channel-id',
    article: $article,
    metadata: [
        'isSponsored' => false,
        'links' => [
            'sections' => ['https://news-api.apple.com/sections/your-section-id']
        ]
    ]
);

echo "Article ID: " . $response['data']['id'];
echo "Share URL: " . $response['data']['shareUrl'];
```

## API Reference

### Channel Operations

```php
// Get channel information
$channel = $client->getChannel($channelId);

// Get channel quota
$quota = $client->getChannelQuota($channelId);
```

### Section Operations

```php
// List all sections
$sections = $client->listSections($channelId);

// Get section details
$section = $client->getSection($sectionId);

// Promote articles in a section
$client->promoteArticles($sectionId, ['article-id-1', 'article-id-2']);
```

### Article Operations

```php
// Create article
$response = $client->createArticle($channelId, $article, $metadata, $assets);

// Get article
$article = $client->getArticle($articleId);

// Search articles in channel
$results = $client->searchArticlesInChannel($channelId, [
    'pageSize' => 10,
    'fromDate' => '2024-01-01',
]);

// Update article (requires revision)
$response = $client->updateArticle(
    $articleId,
    $revision,  // From previous getArticle() response
    $article,
    $metadata,
    $assets
);

// Delete article
$client->deleteArticle($articleId);
```

## Available Components

### Text Components
- `Title` - Article title
- `Heading` - Section headings (levels 1-6)
- `Body` - Body text (supports HTML/Markdown)
- `Caption` - Image captions
- `Pullquote` - Pull quotes

### Media Components
- `Photo` - Single images
- `Gallery` - Image galleries
- `Video` - Native video
- `EmbedWebVideo` - YouTube, Vimeo, etc.

### Social Embeds
- `Tweet` - Twitter/X posts
- `Instagram` - Instagram posts
- `FacebookPost` - Facebook posts

### Layout Components
- `Container` - Group components
- `Divider` - Visual separator
- `LinkButton` - Call-to-action buttons

## Working with Assets

### Bundle Resources

Reference images with `bundle://` URLs and include them when creating:

```php
$article->addComponent(Photo::fromBundle('hero.jpg'));

$response = $client->createArticle($channelId, $article, null, [
    'bundle://hero.jpg' => '/path/to/hero.jpg',  // File path
    'bundle://logo.png' => $binaryContent,        // Or binary content
]);
```

### Remote Images

Use direct URLs (no bundling required):

```php
$article->addComponent(Photo::fromUrl('https://cdn.example.com/image.jpg'));
```

## Error Handling

```php
use TomGould\AppleNews\Exception\AppleNewsException;
use TomGould\AppleNews\Exception\AuthenticationException;

try {
    $client->createArticle($channelId, $article);
} catch (AuthenticationException $e) {
    // Invalid API credentials
    echo "Auth error: " . $e->getMessage();
} catch (AppleNewsException $e) {
    // API error
    echo "Error: " . $e->getMessage();
    echo "Code: " . $e->getErrorCode();
    echo "Key path: " . $e->getKeyPath();
}
```

## Drupal Integration

For Drupal 9/10/11, create a service:

```yaml
# your_module.services.yml
services:
  your_module.apple_news_client:
    class: TomGould\AppleNews\Client\AppleNewsClient
    factory: ['TomGould\AppleNews\Client\AppleNewsClient', 'create']
    arguments:
      - '%your_module.apple_news.key_id%'
      - '%your_module.apple_news.key_secret%'
      - '@http_client'
      - '@Psr\Http\Message\RequestFactoryInterface'
      - '@Psr\Http\Message\StreamFactoryInterface'
```

## Requirements

- PHP 8.1 or higher
- A PSR-18 HTTP client (e.g., Guzzle)
- Apple News Publisher account with API credentials

## Testing

```bash
composer test
```

## License

MIT License. See [LICENSE](LICENSE) for details.

## Credits

Built by [TomGould](https://tomgould.com) as a modern replacement for the unmaintained `chapter-three/apple-news-api` package.
