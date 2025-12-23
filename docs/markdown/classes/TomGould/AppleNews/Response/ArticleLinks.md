
Links associated with an article response.

Contains URLs for related API resources such as the channel,
the article itself, and any sections the article belongs to.

***

* Full name: `\TomGould\AppleNews\Response\ArticleLinks`
* This class is marked as **final** and can't be subclassed
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/applenewsapi/articlelinksresponse

## Properties

### channel

```php
public ?string $channel
```

***

### self

```php
public ?string $self
```

***

### sections

```php
public list<string> $sections
```

***

## Methods

### __construct

Create a new ArticleLinks instance.

```php
public __construct(string|null $channel = null, string|null $self = null, list<string> $sections = []): mixed
```

**Parameters:**

| Parameter   | Type             | Description                                          |
|-------------|------------------|------------------------------------------------------|
| `$channel`  | **string\|null** | URL to the channel resource containing this article. |
| `$self`     | **string\|null** | URL to this article resource.                        |
| `$sections` | **list<string>** | URLs to section resources this article belongs to.   |

***

### fromArray

Create an ArticleLinks instance from API response data.

```php
public static fromArray(array<string,mixed> $data): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type                    | Description                           |
|-----------|-------------------------|---------------------------------------|
| `$data`   | **array<string,mixed>** | The links data from the API response. |

**Return Value:**

A new ArticleLinks instance populated with the response data.

***
