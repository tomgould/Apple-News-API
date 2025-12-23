
Component link for making entire components tappable.

Unlike LinkAddition which targets text ranges, ComponentLink
makes the entire component interactive.

***

* Full name: `\TomGould\AppleNews\Document\Additions\ComponentLink`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Additions\AdditionInterface`](./AdditionInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/componentlink

## Properties

### url

```php
private string $url
```

***

## Methods

### __construct

Create a new ComponentLink.

```php
public __construct(string $url): mixed
```

**Parameters:**

| Parameter | Type       | Description   |
|-----------|------------|---------------|
| `$url`    | **string** | The link URL. |

***

### to

Create a component link with a URL.

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

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
