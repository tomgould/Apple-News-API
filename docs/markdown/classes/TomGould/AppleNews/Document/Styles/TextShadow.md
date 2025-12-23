
Shadow effect for text.

***

* Full name: `\TomGould\AppleNews\Document\Styles\TextShadow`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/textshadow

## Properties

### color

The shadow color.

```php
private ?string $color
```

***

### radius

The blur radius.

```php
private ?int $radius
```

***

### offset

The shadow offset.

```php
private ?\TomGould\AppleNews\Document\Styles\TextShadowOffset $offset
```

***

## Methods

### setColor

Set the shadow color.

```php
public setColor(string $color): $this
```

**Parameters:**

| Parameter | Type       | Description              |
|-----------|------------|--------------------------|
| `$color`  | **string** | The color in hex format. |

***

### setRadius

Set the blur radius.

```php
public setRadius(int $radius): $this
```

**Parameters:**

| Parameter | Type    | Description           |
|-----------|---------|-----------------------|
| `$radius` | **int** | The radius in points. |

***

### setOffset

Set the shadow offset.

```php
public setOffset(\TomGould\AppleNews\Document\Styles\TextShadowOffset $offset): $this
```

**Parameters:**

| Parameter | Type                                                     | Description               |
|-----------|----------------------------------------------------------|---------------------------|
| `$offset` | **\TomGould\AppleNews\Document\Styles\TextShadowOffset** | The offset configuration. |

***

### setOffsetXY

Set the shadow offset using x/y values.

```php
public setOffsetXY(float $x, float $y): $this
```

**Parameters:**

| Parameter | Type      | Description            |
|-----------|-----------|------------------------|
| `$x`      | **float** | The horizontal offset. |
| `$y`      | **float** | The vertical offset.   |

***

### dropShadow

Create a simple drop shadow.

```php
public static dropShadow(string $color = '#00000066', int $radius = 2, float $x = 1, float $y = 1): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description            |
|-----------|------------|------------------------|
| `$color`  | **string** | The shadow color.      |
| `$radius` | **int**    | The blur radius.       |
| `$x`      | **float**  | The horizontal offset. |
| `$y`      | **float**  | The vertical offset.   |

**Return Value:**

A new instance.

***

### subtle

Create a subtle shadow.

```php
public static subtle(): self
```

* This method is **static**.
**Return Value:**

A new instance.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
