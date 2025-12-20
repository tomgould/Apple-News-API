Article metadata for Apple News Format.

Metadata provides information about the article that is not part of the
document content itself, such as authors, canonical URLs, and keywords.

***

* Full name: `\TomGould\AppleNews\Document\Metadata`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`JsonSerializable`](https://www.php.net/manual/en/class.jsonserializable.php)
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

### jsonSerialize

```php
public jsonSerialize(): array<string,mixed>
```

***

