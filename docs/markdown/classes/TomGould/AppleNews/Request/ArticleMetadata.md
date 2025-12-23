
Builder for API-level metadata sent with Create and Update Article requests.

This class handles metadata fields that control how Apple News processes and
displays your article. It is separate from the ANF Metadata class which handles
document-level metadata like authors and publication dates.

Usage:
```php
$metadata = (new ArticleMetadata())
    ->setIsSponsored(true)
    ->setMaturityRating(MaturityRating::GENERAL)
    ->addSection('https://news-api.apple.com/sections/123');

$client->createArticle($channelId, $article, $metadata->toArray());
```

***

* Full name: `\TomGould\AppleNews\Request\ArticleMetadata`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/applenewsapi/create_an_article
* https://developer.apple.com/documentation/applenewsapi/update_an_article

## Properties

### isSponsored

Whether the article contains sponsored content.

```php
private ?bool $isSponsored
```

Required by Apple policy for sponsored/paid content.

***

### isCandidateToBeFeatured

Whether the article should be considered for featuring in Apple News.

```php
private ?bool $isCandidateToBeFeatured
```

***

### isPreview

Whether the article is in preview mode (not publicly visible).

```php
private ?bool $isPreview
```

***

### isHidden

Whether the article is temporarily hidden from the News feed.

```php
private ?bool $isHidden
```

Note: This field is only applicable for Update Article requests.

***

### maturityRating

Content maturity rating for the article.

```php
private ?\TomGould\AppleNews\Enum\MaturityRating $maturityRating
```

***

### targetTerritoryCountryCodes

ISO 3166-1 alpha-2 country codes for content targeting.

```php
private list<string> $targetTerritoryCountryCodes
```

***

### sections

Section URLs to assign the article to.

```php
private list<string> $sections
```

***

## Methods

### setIsSponsored

Mark the article as sponsored content.

```php
public setIsSponsored(bool $isSponsored): $this
```

Apple requires this to be set to true for any paid or sponsored content.
Failure to properly disclose sponsored content may result in channel removal.

**Parameters:**

| Parameter      | Type     | Description                       |
|----------------|----------|-----------------------------------|
| `$isSponsored` | **bool** | Whether the article is sponsored. |

***

### setIsCandidateToBeFeatured

Set whether the article should be considered for featuring.

```php
public setIsCandidateToBeFeatured(bool $isCandidateToBeFeatured): $this
```

When true, the article may be selected by Apple News editors for
prominent placement. Not all articles marked as candidates will be featured.

**Parameters:**

| Parameter                  | Type     | Description                          |
|----------------------------|----------|--------------------------------------|
| `$isCandidateToBeFeatured` | **bool** | Whether the article can be featured. |

***

### setIsPreview

Set whether the article is in preview mode.

```php
public setIsPreview(bool $isPreview): $this
```

Preview articles are only visible to channel members and are not
published to the public Apple News feed.

**Parameters:**

| Parameter    | Type     | Description                       |
|--------------|----------|-----------------------------------|
| `$isPreview` | **bool** | Whether the article is a preview. |

***

### setIsHidden

Set whether the article is hidden from the News feed.

```php
public setIsHidden(bool $isHidden): $this
```

Hidden articles remain accessible via direct link but do not appear
in channel feeds or search results. This is only applicable for
Update Article requests.

**Parameters:**

| Parameter   | Type     | Description                    |
|-------------|----------|--------------------------------|
| `$isHidden` | **bool** | Whether the article is hidden. |

***

### setMaturityRating

Set the content maturity rating.

```php
public setMaturityRating(\TomGould\AppleNews\Enum\MaturityRating $maturityRating): $this
```

The maturity rating helps Apple News determine the appropriate
audience for your content.

**Parameters:**

| Parameter         | Type                                        | Description         |
|-------------------|---------------------------------------------|---------------------|
| `$maturityRating` | **\TomGould\AppleNews\Enum\MaturityRating** | The content rating. |

***

### addTargetTerritory

Add a target territory country code.

```php
public addTargetTerritory(string $countryCode): $this
```

Use ISO 3166-1 alpha-2 country codes (e.g., 'US', 'GB', 'CA').
When set, the article will only be visible to users in the specified countries.

**Parameters:**

| Parameter      | Type       | Description                      |
|----------------|------------|----------------------------------|
| `$countryCode` | **string** | ISO 3166-1 alpha-2 country code. |

***

### addTargetTerritories

Add multiple target territory country codes.

```php
public addTargetTerritories(list<string> $countryCodes): $this
```

**Parameters:**

| Parameter       | Type             | Description                                |
|-----------------|------------------|--------------------------------------------|
| `$countryCodes` | **list<string>** | Array of ISO 3166-1 alpha-2 country codes. |

***

### setTargetTerritories

Set all target territory country codes, replacing any existing values.

```php
public setTargetTerritories(list<string> $countryCodes): $this
```

**Parameters:**

| Parameter       | Type             | Description                                |
|-----------------|------------------|--------------------------------------------|
| `$countryCodes` | **list<string>** | Array of ISO 3166-1 alpha-2 country codes. |

***

### addSection

Add a section URL to assign the article to.

```php
public addSection(string $sectionUrl): $this
```

Articles can belong to multiple sections. Use the full API URL
format: https://news-api.apple.com/sections/{sectionId}

**Parameters:**

| Parameter     | Type       | Description               |
|---------------|------------|---------------------------|
| `$sectionUrl` | **string** | The full section API URL. |

***

### addSectionById

Add a section by ID (convenience method).

```php
public addSectionById(string $sectionId, string $apiBase = 'https://news-api.apple.com'): $this
```

This method constructs the full API URL from the section ID.

**Parameters:**

| Parameter    | Type       | Description                               |
|--------------|------------|-------------------------------------------|
| `$sectionId` | **string** | The section identifier.                   |
| `$apiBase`   | **string** | The API base URL. Defaults to production. |

***

### addSections

Add multiple section URLs.

```php
public addSections(list<string> $sectionUrls): $this
```

**Parameters:**

| Parameter      | Type             | Description                |
|----------------|------------------|----------------------------|
| `$sectionUrls` | **list<string>** | Array of section API URLs. |

***

### setSections

Set all section URLs, replacing any existing values.

```php
public setSections(list<string> $sectionUrls): $this
```

**Parameters:**

| Parameter      | Type             | Description                |
|----------------|------------------|----------------------------|
| `$sectionUrls` | **list<string>** | Array of section API URLs. |

***

### toArray

Convert the metadata to an array suitable for the API request.

```php
public toArray(): array<string,mixed>
```

Only non-null values are included in the output.

**Return Value:**

The metadata array for the API request.

***

### isEmpty

Check if any metadata has been set.

```php
public isEmpty(): bool
```

**Return Value:**

True if at least one metadata field has been set.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
