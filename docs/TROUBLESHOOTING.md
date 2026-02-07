# Apple News API Troubleshooting Guide

Solutions to common problems when using the Apple News API PHP client.

---

## Authentication Errors

### `AuthenticationException: 401 Unauthorized`

**Cause:** Invalid API credentials or malformed signature.

**Solutions:**
1. Verify your Key ID and Secret are correct
2. Ensure the secret is base64-encoded (as provided by Apple)
3. Check server time sync (HMAC signatures are time-sensitive)

```php
// Verify credentials format
$keyId = 'ABC123';           // Alphanumeric
$secret = 'base64string==';  // Must be base64
```

### `AuthenticationException: 403 Forbidden`

**Cause:** Valid credentials but insufficient permissions.

**Solutions:**
1. Verify the channel ID belongs to your account
2. Check API key permissions in Apple News Publisher
3. Ensure the article isn't violating content policies

---

## Document Validation Errors

### `INVALID_DOCUMENT: Invalid identifier`

**Cause:** Article identifier contains invalid characters.

```php
// ❌ Invalid
$article = Article::create('My Article #1', 'Title');

// ✅ Valid (URL-safe characters only)
$article = Article::create('my-article-1', 'Title');
$article = Article::create('article_2024_01_15', 'Title');
```

### `INVALID_DOCUMENT: components[X] missing required field`

**Cause:** A component is missing required properties.

```php
// ❌ Photo without URL
$photo = new Photo();

// ✅ Photo with URL
$photo = Photo::fromUrl('https://example.com/image.jpg');
```

### `INVALID_DOCUMENT: Unknown component role`

**Cause:** Typo in component role or unsupported component.

```php
// Components are created via classes, not arrays
// If you see this error, you may be mixing raw JSON with the library

// ❌ Raw array with typo
$article->addComponent(['role' => 'boddy', 'text' => '...']);

// ✅ Use component classes
$article->addComponent(new Body('...'));
```

### `INVALID_DOCUMENT: Invalid text format`

**Cause:** HTML content without format specification.

```php
// ❌ HTML without format
$body = new Body('<p>Content</p>');

// ✅ Specify HTML format
$body = (new Body('<p>Content</p>'))->setFormat('html');

// ✅ Or use plain text (default)
$body = new Body('Plain content without HTML tags');
```

---

## Asset Errors

### `INVALID_DOCUMENT: Asset not found`

**Cause:** Bundle reference doesn't match provided assets.

```php
// ❌ Mismatch
$photo = Photo::fromBundle('hero.jpg');
$client->createArticle($channelId, $article, null, [
    'bundle://image.jpg' => '/path/to/hero.jpg'  // Wrong key!
]);

// ✅ Keys must match
$photo = Photo::fromBundle('hero.jpg');
$client->createArticle($channelId, $article, null, [
    'bundle://hero.jpg' => '/path/to/hero.jpg'  // Correct
]);
```

### `INVALID_DOCUMENT: Invalid URL format`

**Cause:** Malformed or inaccessible image URL.

```php
// ❌ Local path (not accessible to Apple)
Photo::fromUrl('/var/www/images/hero.jpg');

// ❌ Internal network
Photo::fromUrl('http://192.168.1.100/image.jpg');

// ✅ Public URL
Photo::fromUrl('https://example.com/images/hero.jpg');

// ✅ Or use bundle for local files
Photo::fromBundle('hero.jpg');
```

### `ASSET_INGEST_FAILED`

**Cause:** Apple couldn't download or process the asset.

**Solutions:**
1. Verify the URL is publicly accessible
2. Check image format (JPEG, PNG, GIF supported)
3. Ensure file isn't too large (< 20MB recommended)
4. Confirm no authentication/CORS blocking

```bash
# Test accessibility
curl -I https://example.com/image.jpg
```

---

## Update Errors

### `CONFLICT: Revision mismatch`

**Cause:** Article was modified since you retrieved it.

```php
// ❌ Using stale revision
$client->updateArticle($articleId, $oldRevision, $article);

// ✅ Get fresh revision before updating
$current = $client->getArticle($articleId);
$freshRevision = $current['data']['revision'];
$client->updateArticle($articleId, $freshRevision, $article);
```

### `NOT_FOUND: Article not found`

**Cause:** Article was deleted or ID is incorrect.

```php
// Double-check the article ID format
$articleId = 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx';  // UUID format

// Verify it exists before updating
try {
    $client->getArticle($articleId);
} catch (AppleNewsException $e) {
    // Article doesn't exist
}
```

---

## Layout Issues

### Components Not Rendering

**Cause:** Empty or null components.

```php
// ❌ Empty body is ignored
$article->addComponent(new Body(''));

// ✅ Only add components with content
if (!empty($text)) {
    $article->addComponent(new Body($text));
}
```

### Layout Shifts in Apple News

**Cause:** Missing dimension hints for media.

```php
// ❌ No dimensions = layout shift
$photo = Photo::fromUrl('https://...');

// ✅ Provide dimensions or min-height
$photo = Photo::fromUrl('https://...');
$photo->setLayout(['minimumHeight' => '300pt']);
```

### Content Cut Off

**Cause:** Column span issues.

```php
// ✅ Ensure content spans available columns
$article = Article::create('id', 'title', 'en', columns: 7);

// Component should fit within 7 columns
$component->setLayout([
    'columnStart' => 0,
    'columnSpan' => 7  // Max for 7-column layout
]);
```

---

## Style Issues

### Styles Not Applied

**Cause:** Style name mismatch or missing registration.

```php
// ❌ Using unregistered style
$body->setTextStyle('myStyle');

// ✅ Register the style first
$article->addComponentTextStyle('myStyle', $styleObject);
$body->setTextStyle('myStyle');
```

### Dark Mode Not Working

**Cause:** Missing conditional configuration.

```php
// ❌ Only light mode defined
$style->setTextColor('#000000');

// ✅ Include dark mode conditional
$style
    ->setTextColor('#000000')
    ->setConditional([[
        'conditions' => [['preferredColorScheme' => 'dark']],
        'textColor' => '#FFFFFF'
    ]]);
```

---

## Network/HTTP Errors

### `cURL error: Connection timed out`

**Solutions:**
1. Check internet connectivity
2. Verify firewall allows outbound HTTPS
3. Increase timeout in HTTP client

```php
$httpClient = new Client([
    'timeout' => 60,
    'connect_timeout' => 10,
]);
```

### `cURL error: SSL certificate problem`

**Solutions:**
1. Update CA certificates: `sudo update-ca-certificates`
2. Ensure PHP has valid CA bundle

```php
$httpClient = new Client([
    'verify' => '/path/to/cacert.pem',  // If custom CA needed
]);
```

---

## Debugging Steps

### 1. Export Article JSON

```php
$json = json_encode($article, JSON_PRETTY_PRINT);
file_put_contents('debug-article.json', $json);
```

### 2. Validate with Apple's Tool

Use [Apple News Format Validator](https://developer.apple.com/news-publisher/) to check JSON structure.

### 3. Enable Detailed Logging

```php
use GuzzleHttp\Middleware;
use GuzzleHttp\MessageFormatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('apple-news');
$logger->pushHandler(new StreamHandler('apple-news.log'));

$stack = HandlerStack::create();
$stack->push(Middleware::log($logger, new MessageFormatter('{req_body}\n{res_body}')));

$httpClient = new Client(['handler' => $stack]);
```

### 4. Check Error Details

```php
try {
    $client->createArticle($channelId, $article);
} catch (AppleNewsException $e) {
    echo "Message: " . $e->getMessage() . "\n";
    echo "Code: " . $e->getErrorCode() . "\n";
    echo "KeyPath: " . $e->getKeyPath() . "\n";
    
    // Log the full response
    print_r($e->getResponse());
}
```

---

## Rate Limits

### `429 Too Many Requests`

**Cause:** Exceeded API rate limits.

**Solutions:**
1. Implement exponential backoff
2. Batch operations where possible
3. Cache channel/section data

```php
// Simple retry with backoff
function publishWithRetry($client, $channelId, $article, $maxRetries = 3) {
    for ($i = 0; $i < $maxRetries; $i++) {
        try {
            return $client->createArticle($channelId, $article);
        } catch (AppleNewsException $e) {
            if ($e->getCode() === 429 && $i < $maxRetries - 1) {
                sleep(pow(2, $i));  // 1s, 2s, 4s
                continue;
            }
            throw $e;
        }
    }
}
```

---

## Getting Help

1. Check the [README](../README.md) for basic usage
2. Review the [Cookbook](COOKBOOK.md) for advanced patterns
3. Consult [Apple's documentation](https://developer.apple.com/documentation/applenewsformat)
4. Open an issue on [GitHub](https://github.com/tomgould/apple-news-api/issues)

---

*Last updated: 2026-02-07*
