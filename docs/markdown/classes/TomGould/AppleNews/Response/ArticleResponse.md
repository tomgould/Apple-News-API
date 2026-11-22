
Complete response from Create, Read, and Update Article endpoints.

This class provides a typed representation of the article data returned
by the Apple News API, including metadata, state information, throttling
data, and any warnings generated during processing.

***

* Full name: `\TomGould\AppleNews\Response\ArticleResponse`
* This class is marked as **final** and can't be subclassed
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/applenewsapi/articleresponse

## Properties

### id

```php
public string $id
```

***

### type

```php
public string $type
```

***

### title

```php
public string $title
```

***

### revision

```php
public string $revision
```

***

### state

```php
public ?\TomGould\AppleNews\Enum\ArticleState $state
```

***

### shareUrl

```php
public ?string $shareUrl
```

***

### createdAt

```php
public ?\DateTimeImmutable $createdAt
```

***

### modifiedAt

```php
public ?\DateTimeImmutable $modifiedAt
```

***

### isSponsored

```php
public ?bool $isSponsored
```

***

### isPreview

```php
public ?bool $isPreview
```

***

### isCandidateToBeFeatured

```php
public ?bool $isCandidateToBeFeatured
```

***

### isHidden

```php
public ?bool $isHidden
```

***

### maturityRating

```php
public ?string $maturityRating
```

***

### links

```php
public ?\TomGould\AppleNews\Response\ArticleLinks $links
```

***

### meta

```php
public ?\TomGould\AppleNews\Response\Meta $meta
```

***

### warnings

```php
public array $warnings
```

***

### rawData

```php
public array<string,mixed> $rawData
```

***

## Methods

### __construct

Create a new ArticleResponse instance.

```php
public __construct(string $id, string $type, string $title, string $revision, \TomGould\AppleNews\Enum\ArticleState|null $state = null, string|null $shareUrl = null, \DateTimeImmutable|null $createdAt = null, \DateTimeImmutable|null $modifiedAt = null, bool|null $isSponsored = null, bool|null $isPreview = null, bool|null $isCandidateToBeFeatured = null, bool|null $isHidden = null, string|null $maturityRating = null, \TomGould\AppleNews\Response\ArticleLinks|null $links = null, \TomGould\AppleNews\Response\Meta|null $meta = null, list<\TomGould\AppleNews\Response\Warning> $warnings = [], array<string,mixed> $rawData = []): mixed
```

**Parameters:**

| Parameter                  | Type                                                | Description                                            |
|----------------------------|-----------------------------------------------------|--------------------------------------------------------|
| `$id`                      | **string**                                          | The unique identifier for the article.                 |
| `$type`                    | **string**                                          | The resource type (always "article").                  |
| `$title`                   | **string**                                          | The article title from the Apple News Format document. |
| `$revision`                | **string**                                          | The current revision token for optimistic locking.     |
| `$state`                   | **\TomGould\AppleNews\Enum\ArticleState\|null**     | The current processing state of the article.           |
| `$shareUrl`                | **string\|null**                                    | The public URL to the article in Apple News.           |
| `$createdAt`               | **\DateTimeImmutable\|null**                        | When the article was first created.                    |
| `$modifiedAt`              | **\DateTimeImmutable\|null**                        | When the article was last modified.                    |
| `$isSponsored`             | **bool\|null**                                      | Whether the article is marked as sponsored content.    |
| `$isPreview`               | **bool\|null**                                      | Whether the article is in preview mode.                |
| `$isCandidateToBeFeatured` | **bool\|null**                                      | Whether the article can be featured in Apple News.     |
| `$isHidden`                | **bool\|null**                                      | Whether the article is hidden from feeds.              |
| `$maturityRating`          | **string\|null**                                    | Content maturity rating (KIDS, GENERAL, MATURE).       |
| `$links`                   | **\TomGould\AppleNews\Response\ArticleLinks\|null** | Related API resource URLs.                             |
| `$meta`                    | **\TomGould\AppleNews\Response\Meta\|null**         | Metadata including throttling information.             |
| `$warnings`                | **list<\TomGould\AppleNews\Response\Warning>**      | Non-fatal warnings from the API.                       |
| `$rawData`                 | **array<string,mixed>**                             | Raw response data for unmapped fields.                 |

***

### fromApiResponse

Create an ArticleResponse instance from the raw API response.

```php
public static fromApiResponse(array<string,mixed> $response): self
```

This factory method handles the nested structure of the API response,
extracting data from the 'data', 'links', and 'meta' keys as appropriate.

* This method is **static**.
**Parameters:**

| Parameter   | Type                    | Description                  |
|-------------|-------------------------|------------------------------|
| `$response` | **array<string,mixed>** | The full API response array. |

**Return Value:**

A new ArticleResponse instance populated with the response data.

***

### getThrottling

Get throttling information from the response.

```php
public getThrottling(): \TomGould\AppleNews\Response\Throttling|null
```

Convenience method to access throttling data without navigating
through the meta object.

**Return Value:**

The throttling information, or null if not available.

***

### hasWarnings

Check if the response contains any warnings.

```php
public hasWarnings(): bool
```

**Return Value:**

True if there are one or more warnings.

***
