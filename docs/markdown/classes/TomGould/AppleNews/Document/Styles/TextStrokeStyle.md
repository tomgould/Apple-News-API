
Text outline/stroke styling.

***

* Full name: `\TomGould\AppleNews\Document\Styles\TextStrokeStyle`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/textstrokestyle

## Properties

### color

The stroke color.

```php
private ?string $color
```

***

### width

The stroke width.

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

### create

Create a text stroke.

```php
public static create(string $color, int $width = 1): self
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
