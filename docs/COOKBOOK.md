# Apple News API Cookbook

Advanced patterns, real-world recipes, and edge case handling for the Apple News API PHP client.

---

## Table of Contents

1. [Complex Layouts](#complex-layouts)
2. [Nested Containers](#nested-containers)
3. [Data Tables](#data-tables)
4. [Dark Mode Support](#dark-mode-support)
5. [Advertising Integration](#advertising-integration)
6. [Real-World Article Templates](#real-world-article-templates)
7. [Performance Optimization](#performance-optimization)
8. [Common Pitfalls](#common-pitfalls)
9. [Debugging Tips](#debugging-tips)
10. [Migration Guide](#migration-guide)

---

## Complex Layouts

### Horizontal Stack (Side-by-Side Content)

```php
use TomGould\AppleNews\Document\Components\Container;
use TomGould\AppleNews\Document\Components\Body;
use TomGould\AppleNews\Document\Components\Photo;
use TomGould\AppleNews\Document\Layouts\HorizontalStackDisplay;

$container = new Container();
$container
    ->setContentDisplayObject(new HorizontalStackDisplay())
    ->addComponent(
        Photo::fromUrl('https://example.com/thumbnail.jpg')
            ->setLayout(['minimumWidth' => '30%'])
    )
    ->addComponent(
        (new Body('Article summary text goes here...'))
            ->setLayout(['minimumWidth' => '60%'])
    );

$article->addComponent($container);
```

### Grid Layout (Image Gallery)

```php
use TomGould\AppleNews\Document\Layouts\CollectionDisplay;

$gallery = new Container();
$gallery->setContentDisplayObject(
    CollectionDisplay::grid(gutter: 10, minimumWidth: 150)
);

foreach ($images as $url) {
    $gallery->addComponent(Photo::fromUrl($url));
}

$article->addComponent($gallery);
```

### Two-Column Article Layout

```php
$twoColumnLayout = new Container();
$twoColumnLayout->setContentDisplayObject(new HorizontalStackDisplay());

// Left column - main content (70%)
$mainColumn = new Container();
$mainColumn
    ->setLayout(['minimumWidth' => '70cw']) // 70% column width
    ->addComponent(new Body($mainText));

// Right column - sidebar (30%)
$sidebar = new Container();
$sidebar
    ->setLayout(['minimumWidth' => '30cw'])
    ->addComponent(new Aside('Related articles...'))
    ->addComponent(new LinkButton('Read More', 'https://example.com'));

$twoColumnLayout
    ->addComponent($mainColumn)
    ->addComponent($sidebar);

$article->addComponent($twoColumnLayout);
```

---

## Nested Containers

### Card Component Pattern

```php
use TomGould\AppleNews\Document\Styles\Fills\ColorFill;

function createCard(string $title, string $body, string $imageUrl): Container
{
    $card = new Container();
    
    // Card background
    $card->setStyle([
        'backgroundColor' => '#FFFFFF',
        'border' => [
            'all' => ['width' => 1, 'color' => '#E0E0E0']
        ],
        'mask' => ['type' => 'corners', 'radius' => 12]
    ]);
    
    $card
        ->addComponent(Photo::fromUrl($imageUrl))
        ->addComponent(
            (new Heading($title, level: 3))
                ->setLayout(['margin' => ['top' => 15, 'left' => 15, 'right' => 15]])
        )
        ->addComponent(
            (new Body($body))
                ->setLayout(['margin' => ['left' => 15, 'right' => 15, 'bottom' => 15]])
        );
    
    return $card;
}

// Usage
$cardsContainer = new Container();
$cardsContainer->setContentDisplayObject(
    CollectionDisplay::grid(gutter: 20, minimumWidth: 280)
);

$cardsContainer
    ->addComponent(createCard('Card 1', 'Description...', 'https://...'))
    ->addComponent(createCard('Card 2', 'Description...', 'https://...'))
    ->addComponent(createCard('Card 3', 'Description...', 'https://...'));

$article->addComponent($cardsContainer);
```

### Collapsible Section

```php
$section = new Section();
$section->setIdentifier('expandable-section');

$header = new Header();
$header->addComponent(
    (new Heading('Click to Expand', level: 2))
        ->setAdditions([
            'type' => 'link',
            'URL' => '#expandable-content'
        ])
);

$content = new Container();
$content
    ->setIdentifier('expandable-content')
    ->addComponent(new Body('Hidden content that expands...'));

$section
    ->addComponent($header)
    ->addComponent($content);
```

---

## Data Tables

### Basic Data Table

```php
use TomGould\AppleNews\Document\Components\DataTable;

$table = new DataTable();
$table->setData([
    'descriptors' => [
        ['identifier' => 'name', 'dataType' => 'string', 'label' => 'Product'],
        ['identifier' => 'price', 'dataType' => 'number', 'label' => 'Price ($)'],
        ['identifier' => 'stock', 'dataType' => 'integer', 'label' => 'In Stock'],
    ],
    'records' => [
        ['name' => 'Widget A', 'price' => 19.99, 'stock' => 150],
        ['name' => 'Widget B', 'price' => 29.99, 'stock' => 75],
        ['name' => 'Widget C', 'price' => 9.99, 'stock' => 300],
    ],
]);

$table
    ->setShowDescriptorLabels(true)
    ->addSortBy('price', 'ascending');

$article->addComponent($table);
```

### Styled Data Table

```php
use TomGould\AppleNews\Document\Styles\TableStyle;
use TomGould\AppleNews\Document\Styles\TableCellStyle;
use TomGould\AppleNews\Document\Styles\TableRowStyle;

// Define table style
$tableStyle = new TableStyle();
$tableStyle
    ->setHeaderRowStyle(
        (new TableRowStyle())
            ->setBackgroundColor('#007AFF')
            ->setTextStyle(['textColor' => '#FFFFFF', 'fontWeight' => 'bold'])
    )
    ->setRowStyle(
        (new TableRowStyle())
            ->setBackgroundColor('#FFFFFF')
            ->setDivider(['width' => 1, 'color' => '#E0E0E0'])
    )
    ->setCellStyle(
        (new TableCellStyle())
            ->setPadding(12)
            ->setTextStyle(['fontSize' => 14])
    );

$article->addTableStyle('statsTable', $tableStyle);

$table = new DataTable();
$table
    ->setData($tableData)
    ->setDataTableStyle('statsTable');
```

---

## Dark Mode Support

### Automatic Dark Mode Styling

```php
use TomGould\AppleNews\Document\Conditionals\ConditionalComponentStyle;
use TomGould\AppleNews\Document\Conditionals\ConditionalTextStyle;

// Create styles for both modes
$lightBodyStyle = (new ComponentTextStyle())
    ->setTextColor('#1C1C1E')
    ->setFontSize(17);

$darkBodyStyle = (new ComponentTextStyle())
    ->setTextColor('#F2F2F7')
    ->setFontSize(17)
    ->addCondition(
        ConditionalTextStyle::darkMode(['textColor' => '#F2F2F7'])
    );

$article->addComponentTextStyle('body', $lightBodyStyle);

// Container with dark mode background
$container = new Container();
$container->setStyle([
    'backgroundColor' => '#FFFFFF',
    'conditional' => [
        [
            'conditions' => [['preferredColorScheme' => 'dark']],
            'backgroundColor' => '#1C1C1E'
        ]
    ]
]);
```

### Complete Dark Mode Article

```php
// Document-level dark mode
$documentStyle = new DocumentStyle();
$documentStyle
    ->setBackgroundColor('#FFFFFF')
    ->addConditional([
        'conditions' => [['preferredColorScheme' => 'dark']],
        'backgroundColor' => '#000000'
    ]);

$article->setDocumentStyle($documentStyle);

// Text styles with dark mode variants
$headingStyle = (new ComponentTextStyle())
    ->setTextColor('#000000')
    ->setFontWeight('bold')
    ->setFontSize(28)
    ->setConditional([
        [
            'conditions' => [['preferredColorScheme' => 'dark']],
            'textColor' => '#FFFFFF'
        ]
    ]);

$article->addComponentTextStyle('heading', $headingStyle);
```

---

## Advertising Integration

### Banner Ad Placement

```php
use TomGould\AppleNews\Document\Components\BannerAdvertisement;

// After article intro
$article->addComponent(new Title($title));
$article->addComponent(new Intro($intro));
$article->addComponent(new BannerAdvertisement());  // Auto-placed banner
$article->addComponent(new Body($content));
```

### Auto-Placement Configuration

```php
// Configure automatic ad placement
$article->setAutoplacement([
    'advertisement' => [
        'enabled' => true,
        'bannerType' => 'any',
        'distanceFromMedia' => '10vh',  // 10% viewport height from media
        'frequency' => 5,               // Every 5 components
        'layout' => [
            'margin' => ['top' => 20, 'bottom' => 20]
        ]
    ]
]);
```

### Medium Rectangle Ads in Sidebar

```php
use TomGould\AppleNews\Document\Components\MediumRectangleAdvertisement;

$sidebar = new Container();
$sidebar
    ->setLayout(['minimumWidth' => '300pt'])
    ->addComponent(new Heading('Sponsored', level: 4))
    ->addComponent(new MediumRectangleAdvertisement());
```

---

## Real-World Article Templates

### News Article Template

```php
function createNewsArticle(array $data): Article
{
    $article = Article::create(
        identifier: $data['id'],
        title: $data['title'],
        language: 'en'
    );

    // Metadata
    $article->setMetadata(
        (new Metadata())
            ->addAuthor($data['author'])
            ->setExcerpt($data['excerpt'])
            ->setDatePublished(new DateTime($data['published_at']))
            ->setDateModified(new DateTime($data['updated_at'] ?? 'now'))
            ->setContentGenerationType('none')
            ->addKeywords($data['tags'] ?? [])
    );

    // Hero section
    $article->addComponent(new Title($data['title']));
    
    if (!empty($data['hero_image'])) {
        $article->addComponent(
            (new Figure())
                ->setUrl($data['hero_image'])
                ->setCaption($data['hero_caption'] ?? '')
                ->setAccessibilityCaption($data['hero_alt'] ?? $data['title'])
        );
    }

    // Byline
    $article->addComponent(
        (new Byline(sprintf('By %s | %s', 
            $data['author'],
            (new DateTime($data['published_at']))->format('F j, Y')
        )))
    );

    // Article body (handle paragraphs)
    foreach (explode("\n\n", $data['body']) as $paragraph) {
        if (trim($paragraph)) {
            $article->addComponent(new Body(trim($paragraph)));
        }
    }

    return $article;
}
```

### Long-Form Feature Template

```php
function createFeatureArticle(array $data): Article
{
    $article = Article::create(
        identifier: $data['id'],
        title: $data['title'],
        language: 'en',
        columns: 12,  // More columns for complex layouts
        width: 1280
    );

    // Immersive header with parallax
    $header = new Header();
    $header
        ->setScene(ParallaxScaleHeader::create())
        ->setStyle([
            'fill' => [
                'type' => 'image',
                'URL' => $data['hero_image'],
                'fillMode' => 'cover'
            ]
        ])
        ->addComponent(
            (new Title($data['title']))
                ->setTextStyle([
                    'textColor' => '#FFFFFF',
                    'fontSize' => 48,
                    'textShadow' => [
                        'radius' => 10,
                        'opacity' => 0.5,
                        'color' => '#000000'
                    ]
                ])
        );

    $article->addComponent($header);

    // Drop cap intro
    $article->addComponent(
        (new Intro($data['intro']))
            ->setTextStyle([
                'dropCapStyle' => [
                    'numberOfLines' => 3,
                    'numberOfCharacters' => 1,
                    'fontName' => 'Georgia-Bold'
                ]
            ])
    );

    // Content sections with pull quotes
    foreach ($data['sections'] as $section) {
        $article->addComponent(new Heading($section['title'], level: 2));
        
        if (!empty($section['pullquote'])) {
            $article->addComponent(new Pullquote($section['pullquote']));
        }
        
        $article->addComponent(new Body($section['content']));
        
        if (!empty($section['image'])) {
            $article->addComponent(
                (new Figure())
                    ->setUrl($section['image'])
                    ->setCaption($section['caption'] ?? '')
                    ->setAnimation(FadeInAnimation::standard())
            );
        }
    }

    return $article;
}
```

### Photo Essay Template

```php
function createPhotoEssay(array $data): Article
{
    $article = Article::create(
        identifier: $data['id'],
        title: $data['title'],
        language: 'en'
    );

    $article->addComponent(new Title($data['title']));
    $article->addComponent(new Intro($data['intro']));

    foreach ($data['photos'] as $index => $photo) {
        // Full-bleed image
        $figure = (new Figure())
            ->setUrl($photo['url'])
            ->setCaption($photo['caption'])
            ->setLayout([
                'ignoreDocumentMargin' => true,
                'columnStart' => 0,
                'columnSpan' => 7
            ])
            ->setAnimation(
                $index % 2 === 0 
                    ? MoveInAnimation::fromLeft() 
                    : MoveInAnimation::fromRight()
            );

        $article->addComponent($figure);

        // Optional commentary
        if (!empty($photo['commentary'])) {
            $article->addComponent(
                (new Body($photo['commentary']))
                    ->setLayout([
                        'columnStart' => 1,
                        'columnSpan' => 5
                    ])
            );
        }
    }

    return $article;
}
```

---

## Performance Optimization

### Image Optimization

```php
// Always specify dimensions when known
$photo = Photo::fromUrl('https://example.com/image.jpg');
$photo->setLayout([
    'minimumHeight' => '300pt',  // Prevents layout shift
]);

// Use explicit dimensions for faster rendering
$photo->setExplicitDimensions(width: 1200, height: 800);

// Prefer WebP for smaller file sizes
// Apple News handles format conversion, but starting with optimized images helps
```

### Lazy Component Loading

```php
// For very long articles, consider chunking
function createLongArticle(array $sections): Article
{
    $article = Article::create(/* ... */);
    
    foreach ($sections as $index => $section) {
        // Add a divider between sections for visual breaks
        if ($index > 0) {
            $article->addComponent(new Divider());
        }
        
        // Each section as a container for isolation
        $sectionContainer = new Container();
        $sectionContainer->setIdentifier("section-{$index}");
        
        // ... add section content
        
        $article->addComponent($sectionContainer);
    }
    
    return $article;
}
```

### Asset Bundling Strategy

```php
// For articles with many images, bundle critical assets
$criticalAssets = [
    'bundle://hero.jpg' => '/path/to/hero.jpg',
    'bundle://author.jpg' => '/path/to/author.jpg',
];

// Non-critical images can be remote URLs
// Apple News will fetch and cache them
$article->addComponent(Photo::fromBundle('hero.jpg'));      // Bundled
$article->addComponent(Photo::fromUrl('https://cdn/1.jpg')); // Remote

$client->createArticle($channelId, $article, null, $criticalAssets);
```

---

## Common Pitfalls

### ❌ Missing Required Properties

```php
// WRONG: Photo without URL
$photo = new Photo();  // Will fail validation

// CORRECT:
$photo = Photo::fromUrl('https://example.com/image.jpg');
```

### ❌ Invalid Identifier Format

```php
// WRONG: Spaces and special characters
$article = Article::create(
    identifier: 'My Article #1',  // Invalid!
    // ...
);

// CORRECT: URL-safe identifiers
$article = Article::create(
    identifier: 'my-article-1',
    // ...
);
```

### ❌ Forgetting Revision Token on Updates

```php
// WRONG: Update without revision
$client->updateArticle($articleId, null, $article);  // Will fail!

// CORRECT: Get current revision first
$current = $client->getArticle($articleId);
$revision = $current['data']['revision'];
$client->updateArticle($articleId, $revision, $article);
```

### ❌ Text Format Mismatch

```php
// WRONG: HTML in plain text mode
$body = new Body('<p>Some <strong>bold</strong> text</p>');
// Will render literally as "<p>Some <strong>bold</strong> text</p>"

// CORRECT: Set format explicitly
$body = (new Body('<p>Some <strong>bold</strong> text</p>'))
    ->setFormat('html');
```

### ❌ Asset Path Confusion

```php
// WRONG: Local path as URL
$photo = Photo::fromUrl('/var/www/images/hero.jpg');  // Won't work!

// CORRECT: Use bundle for local files
$photo = Photo::fromBundle('hero.jpg');
// Then provide the mapping when publishing:
$client->createArticle($channelId, $article, null, [
    'bundle://hero.jpg' => '/var/www/images/hero.jpg'
]);
```

---

## Debugging Tips

### Validate Before Publishing

```php
// Export to JSON for inspection
$json = json_encode($article, JSON_PRETTY_PRINT);
file_put_contents('debug-article.json', $json);

// Validate with Apple's format
// https://developer.apple.com/news-publisher/
```

### Catch Detailed Errors

```php
try {
    $response = $client->createArticle($channelId, $article);
} catch (AppleNewsException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Code: " . $e->getErrorCode() . "\n";
    echo "KeyPath: " . $e->getKeyPath() . "\n";  // Shows exactly which field failed
    
    // Log the full request for debugging
    file_put_contents('failed-article.json', json_encode($article, JSON_PRETTY_PRINT));
}
```

### Test Locally

```php
// Create a test harness
function testArticleStructure(Article $article): array
{
    $errors = [];
    $json = $article->jsonSerialize();
    
    // Check required fields
    if (empty($json['identifier'])) {
        $errors[] = 'Missing identifier';
    }
    if (empty($json['title'])) {
        $errors[] = 'Missing title';
    }
    if (empty($json['components'])) {
        $errors[] = 'No components';
    }
    
    // Check component structure
    foreach ($json['components'] ?? [] as $i => $component) {
        if (empty($component['role'])) {
            $errors[] = "Component {$i} missing role";
        }
    }
    
    return $errors;
}
```

---

## Migration Guide

### From Older Versions

```php
// v1.x → v2.x changes:

// OLD: Array-based layout
$component->setLayout(['columnSpan' => 5]);

// NEW: Same, but with type-safe options available
use TomGould\AppleNews\Document\Layouts\ComponentLayout;
$component->setLayoutObject(
    (new ComponentLayout())->setColumnSpan(5)
);

// OLD: Manual JSON for styles
$article->addComponentStyle('myStyle', [
    'backgroundColor' => '#FFF'
]);

// NEW: Type-safe style objects
use TomGould\AppleNews\Document\Styles\ComponentStyle;
$article->addComponentStyleObject('myStyle', 
    (new ComponentStyle())->setBackgroundColor('#FFF')
);
```

### From Raw JSON to This Library

```php
// If migrating from hand-crafted JSON:

// OLD JSON structure:
$json = [
    'identifier' => '123',
    'title' => 'Test',
    'components' => [
        ['role' => 'body', 'text' => 'Hello']
    ]
];

// NEW: Use the fluent API
$article = Article::create('123', 'Test', 'en');
$article->addComponent(new Body('Hello'));

// The jsonSerialize() output will match your old structure
```

---

## Additional Resources

- [Apple News Format Specification](https://developer.apple.com/documentation/applenewsformat)
- [Apple News Publisher Guide](https://support.apple.com/guide/news-publisher/welcome/web)
- [API Reference](https://developer.apple.com/documentation/applenewsapi)

---

*Last updated: 2026-02-07*
