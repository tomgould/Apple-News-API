
Linear gradient background fill.

***

* Full name: `\TomGould\AppleNews\Document\Styles\Fills\LinearGradientFill`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Styles\Fills\FillInterface`](./FillInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/lineargradientfill

## Properties

### colorStops

The color stops.

```php
private list<\TomGould\AppleNews\Document\Styles\Fills\ColorStop> $colorStops
```

***

### angle

The gradient angle in degrees.

```php
private ?float $angle
```

***

## Methods

### getType

Get the fill type identifier.

```php
public getType(): string
```

**Return Value:**

The fill type.

***

### addColorStop

Add a color stop.

```php
public addColorStop(\TomGould\AppleNews\Document\Styles\Fills\ColorStop $stop): $this
```

**Parameters:**

| Parameter | Type                                                    | Description     |
|-----------|---------------------------------------------------------|-----------------|
| `$stop`   | **\TomGould\AppleNews\Document\Styles\Fills\ColorStop** | The color stop. |

***

### addStop

Add a color stop at a location.

```php
public addStop(string $color, float $location): $this
```

**Parameters:**

| Parameter   | Type       | Description           |
|-------------|------------|-----------------------|
| `$color`    | **string** | The color.            |
| `$location` | **float**  | The location (0-100). |

***

### setAngle

Set the gradient angle.

```php
public setAngle(float $angle): $this
```

**Parameters:**

| Parameter | Type      | Description           |
|-----------|-----------|-----------------------|
| `$angle`  | **float** | The angle in degrees. |

***

### vertical

Create a vertical gradient (top to bottom).

```php
public static vertical(string $startColor, string $endColor): self
```

* This method is **static**.
**Parameters:**

| Parameter     | Type       | Description      |
|---------------|------------|------------------|
| `$startColor` | **string** | The start color. |
| `$endColor`   | **string** | The end color.   |

**Return Value:**

A new instance.

***

### horizontal

Create a horizontal gradient (left to right).

```php
public static horizontal(string $startColor, string $endColor): self
```

* This method is **static**.
**Parameters:**

| Parameter     | Type       | Description      |
|---------------|------------|------------------|
| `$startColor` | **string** | The start color. |
| `$endColor`   | **string** | The end color.   |

**Return Value:**

A new instance.

***

### diagonal

Create a diagonal gradient (top-left to bottom-right).

```php
public static diagonal(string $startColor, string $endColor): self
```

* This method is **static**.
**Parameters:**

| Parameter     | Type       | Description      |
|---------------|------------|------------------|
| `$startColor` | **string** | The start color. |
| `$endColor`   | **string** | The end color.   |

**Return Value:**

A new instance.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
