
Video background fill.

***

* Full name: `\TomGould\AppleNews\Document\Styles\Fills\VideoFill`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Styles\Fills\FillInterface`](./FillInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/videofill

## Constants

| Constant     | Visibility | Type | Value   |
|--------------|------------|------|---------|
| `FILL_COVER` | public     |      | 'cover' |
| `FILL_FIT`   | public     |      | 'fit'   |

## Properties

### fillMode

The fill mode.

```php
private ?string $fillMode
```

***

### verticalAlignment

The vertical alignment.

```php
private ?string $verticalAlignment
```

***

### horizontalAlignment

The horizontal alignment.

```php
private ?string $horizontalAlignment
```

***

### loop

Whether to loop the video.

```php
private ?bool $loop
```

***

### stillURL

The still image URL to show while loading.

```php
private ?string $stillURL
```

***

### url

```php
private string $url
```

***

## Methods

### __construct

Create a new VideoFill.

```php
public __construct(string $url): mixed
```

**Parameters:**

| Parameter | Type       | Description    |
|-----------|------------|----------------|
| `$url`    | **string** | The video URL. |

***

### fromUrl

Create a VideoFill from a URL.

```php
public static fromUrl(string $url): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description    |
|-----------|------------|----------------|
| `$url`    | **string** | The video URL. |

**Return Value:**

A new instance.

***

### fromBundle

Create a VideoFill from a bundle file.

```php
public static fromBundle(string $filename): self
```

* This method is **static**.
**Parameters:**

| Parameter   | Type       | Description                 |
|-------------|------------|-----------------------------|
| `$filename` | **string** | The filename in the bundle. |

**Return Value:**

A new instance.

***

### getType

Get the fill type identifier.

```php
public getType(): string
```

**Return Value:**

The fill type.

***

### setFillMode

Set the fill mode.

```php
public setFillMode(string $mode): $this
```

**Parameters:**

| Parameter | Type       | Description            |
|-----------|------------|------------------------|
| `$mode`   | **string** | One of 'cover', 'fit'. |

***

### setVerticalAlignment

Set the vertical alignment.

```php
public setVerticalAlignment(string $alignment): $this
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$alignment` | **string** | One of 'top', 'center', 'bottom'. |

***

### setHorizontalAlignment

Set the horizontal alignment.

```php
public setHorizontalAlignment(string $alignment): $this
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$alignment` | **string** | One of 'left', 'center', 'right'. |

***

### setLoop

Set whether to loop the video.

```php
public setLoop(bool $loop): $this
```

**Parameters:**

| Parameter | Type     | Description      |
|-----------|----------|------------------|
| `$loop`   | **bool** | Whether to loop. |

***

### setStillURL

Set the still image URL.

```php
public setStillURL(string $url): $this
```

**Parameters:**

| Parameter | Type       | Description          |
|-----------|------------|----------------------|
| `$url`    | **string** | The still image URL. |

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
