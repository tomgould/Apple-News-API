
Shadow effect for components.

***

* Full name: `\TomGould\AppleNews\Document\Styles\ComponentShadow`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/componentshadow

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

### opacity

The shadow opacity (0.0 to 1.0).

```php
private ?float $opacity
```

***

### offsetX

The horizontal offset.

```php
private ?int $offsetX
```

***

### offsetY

The vertical offset.

```php
private ?int $offsetY
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

### setOpacity

Set the opacity.

```php
public setOpacity(float $opacity): $this
```

**Parameters:**

| Parameter  | Type      | Description              |
|------------|-----------|--------------------------|
| `$opacity` | **float** | Opacity from 0.0 to 1.0. |

***

### setOffset

Set the offset.

```php
public setOffset(int $x, int $y): $this
```

**Parameters:**

| Parameter | Type    | Description                      |
|-----------|---------|----------------------------------|
| `$x`      | **int** | The horizontal offset in points. |
| `$y`      | **int** | The vertical offset in points.   |

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

### medium

Create a medium shadow.

```php
public static medium(): self
```

* This method is **static**.
**Return Value:**

A new instance.

***

### strong

Create a strong shadow.

```php
public static strong(): self
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
