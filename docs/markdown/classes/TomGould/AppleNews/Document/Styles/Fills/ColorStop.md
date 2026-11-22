
Color stop for gradient fills.

***

* Full name: `\TomGould\AppleNews\Document\Styles\Fills\ColorStop`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/colorstop

## Properties

### color

```php
private string $color
```

***

### location

```php
private float $location
```

***

## Methods

### __construct

Create a new ColorStop.

```php
public __construct(string $color, float $location): mixed
```

**Parameters:**

| Parameter   | Type       | Description                                |
|-------------|------------|--------------------------------------------|
| `$color`    | **string** | The color in hex format.                   |
| `$location` | **float**  | The location (0.0 to 100.0 as percentage). |

***

### at

Create a color stop.

```php
public static at(string $color, float $location): self
```

* This method is **static**.
**Parameters:**

| Parameter   | Type       | Description                      |
|-------------|------------|----------------------------------|
| `$color`    | **string** | The color.                       |
| `$location` | **float**  | The location percentage (0-100). |

**Return Value:**

A new instance.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array{color: string, location: float}
```

***
