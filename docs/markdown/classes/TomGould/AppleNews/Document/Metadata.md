
Article metadata for Apple News Format.

Metadata provides information about the article that is not part of the
document content itself, such as authors, canonical URLs, and keywords.

***

* Full name: `\TomGould\AppleNews\Document\Metadata`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/applenewsformat/metadata

## Properties

### authors

```php
private string[] $authors
```

***

### canonicalURL

```php
private string|null $canonicalURL
```

***

### dateCreated

```php
private string|null $dateCreated
```

***

### dateModified

```php
private string|null $dateModified
```

***

### datePublished

```php
private string|null $datePublished
```

***

### excerpt

```php
private string|null $excerpt
```

***

### generatorIdentifier

```php
private string|null $generatorIdentifier
```

***

### generatorName

```php
private string|null $generatorName
```

***

### generatorVersion

```php
private string|null $generatorVersion
```

***

### keywords

```php
private string[] $keywords
```

***

### links

```php
private array<string,string>[] $links
```

***

### thumbnailURL

```php
private string|null $thumbnailURL
```

***

### transparentToolbar

```php
private bool|null $transparentToolbar
```

***

### videoURL

```php
private string|null $videoURL
```

***

### contentGenerationType

Content generation type indicator.

```php
private ?string $contentGenerationType
```

Set to "AI" for AI-generated content as required by Apple policy.

***

### campaignData

Campaign data for advertising targeting.

```php
private array<string,list<string>>|null $campaignData
```

***

### issue

Issue information for magazine/periodical content.

```php
private ?\TomGould\AppleNews\Document\Issue $issue
```

***

## Methods

### addAuthor

Add an author name.

```php
public addAuthor(string $author): self
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$author` | **string** |             |

***

### setCanonicalURL

Set the canonical URL.

```php
public setCanonicalURL(string $url): self
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$url`    | **string** |             |

***

### setDateCreated

Set the date the article was created.

```php
public setDateCreated(\DateTimeInterface|string $date): self
```

**Parameters:**

| Parameter | Type                           | Description |
|-----------|--------------------------------|-------------|
| `$date`   | **\DateTimeInterface\|string** |             |

***

### setDateModified

Set the date the article was last modified.

```php
public setDateModified(\DateTimeInterface|string $date): self
```

**Parameters:**

| Parameter | Type                           | Description |
|-----------|--------------------------------|-------------|
| `$date`   | **\DateTimeInterface\|string** |             |

***

### setDatePublished

Set the date the article was published.

```php
public setDatePublished(\DateTimeInterface|string $date): self
```

**Parameters:**

| Parameter | Type                           | Description |
|-----------|--------------------------------|-------------|
| `$date`   | **\DateTimeInterface\|string** |             |

***

### setExcerpt

Set the article excerpt/summary.

```php
public setExcerpt(string $excerpt): self
```

**Parameters:**

| Parameter  | Type       | Description |
|------------|------------|-------------|
| `$excerpt` | **string** |             |

***

### setGeneratorIdentifier

Set the generator identifier (e.g., 'Drupal').

```php
public setGeneratorIdentifier(string $identifier): self
```

**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$identifier` | **string** |             |

***

### setGeneratorName

Set the name of the tool that generated this document.

```php
public setGeneratorName(string $name): self
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$name`   | **string** |             |

***

### setGeneratorVersion

Set the version string for the generator tool.

```php
public setGeneratorVersion(string $version): self
```

**Parameters:**

| Parameter  | Type       | Description |
|------------|------------|-------------|
| `$version` | **string** |             |

***

### addKeyword

Add a single keyword.

```php
public addKeyword(string $keyword): self
```

**Parameters:**

| Parameter  | Type       | Description |
|------------|------------|-------------|
| `$keyword` | **string** |             |

***

### addKeywords

Add multiple keywords at once.

```php
public addKeywords(string[] $keywords): self
```

**Parameters:**

| Parameter   | Type         | Description |
|-------------|--------------|-------------|
| `$keywords` | **string[]** |             |

***

### addLinkedArticle

Add a link to a related article or resource.

```php
public addLinkedArticle(string $url, string $relationship): self
```

**Parameters:**

| Parameter       | Type       | Description                          |
|-----------------|------------|--------------------------------------|
| `$url`          | **string** | Target URL.                          |
| `$relationship` | **string** | Relationship type (e.g., 'related'). |

***

### setThumbnailURL

Set the thumbnail image URL for article discovery.

```php
public setThumbnailURL(string $url): self
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$url`    | **string** |             |

***

### setTransparentToolbar

Enable or disable transparent toolbar in the news app.

```php
public setTransparentToolbar(bool $transparent): self
```

**Parameters:**

| Parameter      | Type     | Description |
|----------------|----------|-------------|
| `$transparent` | **bool** |             |

***

### setVideoURL

Set the video URL to be used in the article tile.

```php
public setVideoURL(string $url): self
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$url`    | **string** |             |

***

### setContentGenerationType

Set the content generation type.

```php
public setContentGenerationType(string $type): $this
```

Use "AI" to indicate that the article content was generated by artificial
intelligence. This disclosure is required by Apple policy for AI-generated content.

**Parameters:**

| Parameter | Type       | Description                               |
|-----------|------------|-------------------------------------------|
| `$type`   | **string** | The content generation type (e.g., "AI"). |

***

### setAsAIGenerated

Mark the content as AI-generated.

```php
public setAsAIGenerated(): $this
```

Convenience method that sets contentGenerationType to "AI".
Use this for any content that was primarily generated by AI.

***

### setCampaignData

Set campaign data for advertising targeting.

```php
public setCampaignData(array<string,list<string>> $campaignData): $this
```

Campaign data allows you to provide key-value pairs that can be used
for advertising targeting. Each key maps to an array of string values.

Example:
```php
$metadata->setCampaignData([
    'sport' => ['football', 'basketball'],
    'region' => ['west-coast']
]);
```

**Parameters:**

| Parameter       | Type                           | Description                       |
|-----------------|--------------------------------|-----------------------------------|
| `$campaignData` | **array<string,list<string>>** | Key-value pairs for ad targeting. |

***

### addCampaignData

Add a campaign data entry.

```php
public addCampaignData(string $key, list<string> $values): $this
```

Adds or merges values for a specific campaign data key.

**Parameters:**

| Parameter | Type             | Description                            |
|-----------|------------------|----------------------------------------|
| `$key`    | **string**       | The campaign data key.                 |
| `$values` | **list<string>** | The values to associate with this key. |

***

### setIssue

Set the issue information for magazine/periodical content.

```php
public setIssue(\TomGould\AppleNews\Document\Issue $issue): $this
```

Use this to associate the article with a specific publication issue.

**Parameters:**

| Parameter | Type                                   | Description       |
|-----------|----------------------------------------|-------------------|
| `$issue`  | **\TomGould\AppleNews\Document\Issue** | The issue object. |

***

### setIssueFromArray

Set issue information from an array.

```php
public setIssueFromArray(array<string,mixed> $issueData): $this
```

Convenience method to set issue data without creating an Issue object.

Example:
```php
$metadata->setIssueFromArray([
    'issueIdentifier' => 'issue-2024-01',
    'issueDate' => '2024-01-15',
    'issueName' => 'January 2024'
]);
```

**Parameters:**

| Parameter    | Type                    | Description     |
|--------------|-------------------------|-----------------|
| `$issueData` | **array<string,mixed>** | The issue data. |

***

### jsonSerialize

```php
public jsonSerialize(): array<string,mixed>
```

***
