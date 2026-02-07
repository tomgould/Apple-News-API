# Apple News API Quick Reference

One-page reference for common operations.

---

## Setup

```php
use TomGould\AppleNews\Client\AppleNewsClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;

$factory = new HttpFactory();
$client = AppleNewsClient::create(
    keyId: 'KEY_ID',
    keySecret: 'SECRET',
    httpClient: new Client(),
    requestFactory: $factory,
    streamFactory: $factory
);
```

---

## Article Basics

```php
use TomGould\AppleNews\Document\Article;
use TomGould\AppleNews\Document\Metadata;

$article = Article::create('id', 'Title', 'en');

$article->setMetadata(
    (new Metadata())
        ->addAuthor('Name')
        ->setExcerpt('Summary')
        ->setDatePublished(new DateTime())
);
```

---

## Components Quick Reference

### Text
```php
new Title('Title');
new Heading('Heading', level: 2);  // 1-6
new Body('Paragraph text');
new Intro('Lead paragraph');
new Caption('Caption text');
new Pullquote('Quote text');
new Quote('Block quote');
new Byline('By Author');
```

### Media
```php
Photo::fromUrl('https://...');
Photo::fromBundle('image.jpg');
(new Figure())->setUrl('...')->setCaption('...');
(new Video())->setUrl('...');
(new Audio())->setUrl('...');
(new Gallery())->addItem(...);
```

### Embeds
```php
new Tweet('https://twitter.com/...');
new Instagram('https://instagram.com/...');
new EmbedWebVideo('https://youtube.com/...');
new FacebookPost('https://facebook.com/...');
new TikTok('https://tiktok.com/...');
```

### Structure
```php
new Container();  // Group components
new Section();    // Article section
new Header();     // Section header
new Divider();    // Visual separator
new Aside('...');  // Sidebar
```

### Interactive
```php
new LinkButton('Text', 'https://...');
new Map(latitude: 51.5, longitude: -0.1);
new DataTable();
```

---

## Styles

```php
use TomGould\AppleNews\Document\Styles\ComponentTextStyle;

$style = (new ComponentTextStyle())
    ->setFontName('Helvetica')
    ->setFontSize(18)
    ->setLineHeight(24)
    ->setTextColor('#333333')
    ->setFontWeight('bold');

$article->addComponentTextStyle('styleName', $style);
$component->setTextStyle('styleName');
```

---

## Layouts

```php
// Inline layout
$component->setLayout([
    'columnStart' => 0,
    'columnSpan' => 7,
    'margin' => ['top' => 20, 'bottom' => 20]
]);

// Container display modes
$container->setContentDisplay(['type' => 'horizontal_stack']);
$container->setContentDisplay(['type' => 'collection', 'gutter' => 10]);
```

---

## Animations

```php
use TomGould\AppleNews\Document\Animations\*;

$component->setAnimation(FadeInAnimation::standard());
$component->setAnimation(MoveInAnimation::fromLeft());
$component->setAnimation(ScaleFadeAnimation::subtle());
```

---

## Behaviors

```php
use TomGould\AppleNews\Document\Behaviors\*;

$component->setBehavior(Parallax::withFactor(0.5));
$component->setBehavior(Springy::create());
$component->setBehavior(BackgroundParallax::withFactor(0.8));
```

---

## API Operations

```php
// Create
$response = $client->createArticle($channelId, $article);
$articleId = $response['data']['id'];

// Create with assets
$client->createArticle($channelId, $article, null, [
    'bundle://hero.jpg' => '/path/to/hero.jpg'
]);

// Read
$data = $client->getArticle($articleId);

// Update (requires revision)
$revision = $data['data']['revision'];
$client->updateArticle($articleId, $revision, $article);

// Delete
$client->deleteArticle($articleId);

// Search
$results = $client->searchArticlesInChannel($channelId, [
    'pageSize' => 20
]);
```

---

## Error Handling

```php
use TomGould\AppleNews\Exception\AppleNewsException;
use TomGould\AppleNews\Exception\AuthenticationException;

try {
    $client->createArticle($channelId, $article);
} catch (AuthenticationException $e) {
    // 401/403
} catch (AppleNewsException $e) {
    echo $e->getMessage();
    echo $e->getErrorCode();  // e.g., 'INVALID_DOCUMENT'
    echo $e->getKeyPath();    // e.g., 'components[0].text'
}
```

---

## Dark Mode

```php
// Conditional style
$style->setConditional([[
    'conditions' => [['preferredColorScheme' => 'dark']],
    'textColor' => '#FFFFFF'
]]);

// Component background
$container->setStyle([
    'backgroundColor' => '#FFFFFF',
    'conditional' => [[
        'conditions' => [['preferredColorScheme' => 'dark']],
        'backgroundColor' => '#1C1C1E'
    ]]
]);
```

---

## Common Patterns

### HTML Content
```php
(new Body('<p>HTML <strong>content</strong></p>'))
    ->setFormat('html');
```

### Accessibility
```php
$photo->setAccessibilityCaption('Description for screen readers');
```

### Full-Bleed Image
```php
$photo->setLayout([
    'ignoreDocumentMargin' => true,
    'columnStart' => 0,
    'columnSpan' => 7
]);
```

---

## Metadata Fields

```php
$metadata = (new Metadata())
    ->addAuthor('Name')
    ->setExcerpt('Summary')
    ->setDatePublished(new DateTime())
    ->setDateModified(new DateTime())
    ->addKeywords(['tag1', 'tag2'])
    ->setContentGenerationType('none')  // AI disclosure
    ->setCampaignData(['campaign' => 'value'])
    ->setVideoUrl('https://...')         // Video thumbnail in feeds
    ->setTransparentToolbar(true)        // For immersive headers
    ->setLinks([
        ['URL' => 'https://...', 'type' => 'website']
    ]);
```

---

## Request Metadata

```php
use TomGould\AppleNews\Request\ArticleMetadata;
use TomGould\AppleNews\Enum\MaturityRating;

$requestMeta = (new ArticleMetadata())
    ->setIsSponsored(false)
    ->setIsCandidateToBeFeatured(true)
    ->setMaturityRating(MaturityRating::GENERAL)
    ->addTargetTerritories(['US', 'GB', 'CA'])
    ->addSections(['section-id']);

$client->createArticle($channelId, $article, $requestMeta->toArray());
```

---

*Tip: Use `json_encode($article, JSON_PRETTY_PRINT)` to debug article structure.*
