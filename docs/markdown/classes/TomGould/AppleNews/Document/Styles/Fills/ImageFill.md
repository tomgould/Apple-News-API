
Image background fill.

***

* Full name: `\TomGould\AppleNews\Document\Styles\Fills\ImageFill`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Styles\Fills\FillInterface`](./FillInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/imagefill

## Constants

| Constant       | Visibility | Type | Value    |
|----------------|------------|------|----------|
| `FILL_COVER`   | public     |      | 'cover'  |
| `FILL_FIT`     | public     |      | 'fit'    |
| `ALIGN_TOP`    | public     |      | 'top'    |
| `ALIGN_CENTER` | public     |      | 'center' |
| `ALIGN_BOTTOM` | public     |      | 'bottom' |
| `ALIGN_LEFT`   | public     |      | 'left'   |
| `ALIGN_RIGHT`  | public     |      | 'right'  |

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

### url

```php
private string $url
```

***

## Methods

### __construct

Create a new ImageFill.

```php
public __construct(string $url): mixed
```

**Parameters:**

| Parameter | Type       | Description    |
|-----------|------------|----------------|
| `$url`    | **string** | The image URL. |

***

### fromUrl

Create an ImageFill from a URL.

```php
public static fromUrl(string $url): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description    |
|-----------|------------|----------------|
| `$url`    | **string** | The image URL. |

**Return Value:**

A new instance.

***

### fromBundle

Create an ImageFill from a bundle file.

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

### asCover

Set to cover mode.

```php
public asCover(): $this
```

***

### asFit

Set to fit mode.

```php
public asFit(): $this
```

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
