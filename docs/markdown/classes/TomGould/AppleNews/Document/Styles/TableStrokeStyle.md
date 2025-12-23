
Stroke style for table borders and dividers.

***

* Full name: `\TomGould\AppleNews\Document\Styles\TableStrokeStyle`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/tablestrokestyle

## Properties

### color

The stroke color.

```php
private ?string $color
```

***

### style

The stroke style.

```php
private ?string $style
```

***

### width

The stroke width in points.

```php
private ?int $width
```

***

## Methods

### setColor

Set the stroke color.

```php
public setColor(string $color): $this
```

**Parameters:**

| Parameter | Type       | Description              |
|-----------|------------|--------------------------|
| `$color`  | **string** | The color in hex format. |

***

### setStyle

Set the stroke style.

```php
public setStyle(string $style): $this
```

**Parameters:**

| Parameter | Type       | Description                         |
|-----------|------------|-------------------------------------|
| `$style`  | **string** | One of 'solid', 'dashed', 'dotted'. |

***

### setWidth

Set the stroke width.

```php
public setWidth(int $width): $this
```

**Parameters:**

| Parameter | Type    | Description          |
|-----------|---------|----------------------|
| `$width`  | **int** | The width in points. |

***

### solid

Create a solid stroke.

```php
public static solid(string $color, int $width = 1): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description       |
|-----------|------------|-------------------|
| `$color`  | **string** | The stroke color. |
| `$width`  | **int**    | The stroke width. |

**Return Value:**

A new instance.

***

### dashed

Create a dashed stroke.

```php
public static dashed(string $color, int $width = 1): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description       |
|-----------|------------|-------------------|
| `$color`  | **string** | The stroke color. |
| `$width`  | **int**    | The stroke width. |

**Return Value:**

A new instance.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
