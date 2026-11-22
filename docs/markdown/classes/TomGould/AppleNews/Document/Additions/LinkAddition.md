
Link addition for making text ranges tappable.

Used within text components to create hyperlinks on specific
ranges of text.

***

* Full name: `\TomGould\AppleNews\Document\Additions\LinkAddition`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Additions\AdditionInterface`](./AdditionInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/link

## Properties

### rangeStart

The start position of the link range.

```php
private ?int $rangeStart
```

***

### rangeLength

The length of the link range.

```php
private ?int $rangeLength
```

***

### url

```php
private string $url
```

***

## Methods

### __construct

Create a new LinkAddition.

```php
public __construct(string $url): mixed
```

**Parameters:**

| Parameter | Type       | Description   |
|-----------|------------|---------------|
| `$url`    | **string** | The link URL. |

***

### to

Create a link addition with a URL.

```php
public static to(string $url): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description         |
|-----------|------------|---------------------|
| `$url`    | **string** | The URL to link to. |

**Return Value:**

A new instance.

***

### getType

Get the addition type identifier.

```php
public getType(): string
```

**Return Value:**

The addition type.

***

### setRange

Set the text range for this link.

```php
public setRange(int $start, int $length): $this
```

**Parameters:**

| Parameter | Type    | Description                      |
|-----------|---------|----------------------------------|
| `$start`  | **int** | The starting character position. |
| `$length` | **int** | The number of characters.        |

***

### forRange

Create a link for a specific text range.

```php
public static forRange(string $url, int $start, int $length): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description                      |
|-----------|------------|----------------------------------|
| `$url`    | **string** | The URL to link to.              |
| `$start`  | **int**    | The starting character position. |
| `$length` | **int**    | The number of characters.        |

**Return Value:**

A new instance.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
