
Tiled/repeatable image background fill.

***

* Full name: `\TomGould\AppleNews\Document\Styles\Fills\RepeatableImageFill`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Styles\Fills\FillInterface`](./FillInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/repeatableimagefill

## Constants

| Constant      | Visibility | Type | Value  |
|---------------|------------|------|--------|
| `REPEAT_BOTH` | public     |      | 'both' |
| `REPEAT_X`    | public     |      | 'x'    |
| `REPEAT_Y`    | public     |      | 'y'    |
| `REPEAT_NONE` | public     |      | 'none' |

## Properties

### repeat

The repeat mode.

```php
private ?string $repeat
```

***

### width

The width of each tile.

```php
private ?int $width
```

***

### height

The height of each tile.

```php
private ?int $height
```

***

### url

```php
private string $url
```

***

## Methods

### __construct

Create a new RepeatableImageFill.

```php
public __construct(string $url): mixed
```

**Parameters:**

| Parameter | Type       | Description    |
|-----------|------------|----------------|
| `$url`    | **string** | The image URL. |

***

### fromUrl

Create a RepeatableImageFill from a URL.

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

Create a RepeatableImageFill from a bundle file.

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

### setRepeat

Set the repeat mode.

```php
public setRepeat(string $repeat): $this
```

**Parameters:**

| Parameter | Type       | Description                      |
|-----------|------------|----------------------------------|
| `$repeat` | **string** | One of 'both', 'x', 'y', 'none'. |

***

### repeatBoth

Set to repeat in both directions.

```php
public repeatBoth(): $this
```

***

### repeatX

Set to repeat horizontally only.

```php
public repeatX(): $this
```

***

### repeatY

Set to repeat vertically only.

```php
public repeatY(): $this
```

***

### setWidth

Set the tile width.

```php
public setWidth(int $width): $this
```

**Parameters:**

| Parameter | Type    | Description          |
|-----------|---------|----------------------|
| `$width`  | **int** | The width in points. |

***

### setHeight

Set the tile height.

```php
public setHeight(int $height): $this
```

**Parameters:**

| Parameter | Type    | Description           |
|-----------|---------|-----------------------|
| `$height` | **int** | The height in points. |

***

### setSize

Set the tile size.

```php
public setSize(int $width, int $height): $this
```

**Parameters:**

| Parameter | Type    | Description           |
|-----------|---------|-----------------------|
| `$width`  | **int** | The width in points.  |
| `$height` | **int** | The height in points. |

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
