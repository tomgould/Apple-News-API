
Offset positioning for text shadows.

***

* Full name: `\TomGould\AppleNews\Document\Styles\TextShadowOffset`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/textshadowoffset

## Properties

### x

```php
private float $x
```

***

### y

```php
private float $y
```

***

## Methods

### __construct

Create a new TextShadowOffset.

```php
public __construct(float $x = 0, float $y = 0): mixed
```

**Parameters:**

| Parameter | Type      | Description                      |
|-----------|-----------|----------------------------------|
| `$x`      | **float** | The horizontal offset in points. |
| `$y`      | **float** | The vertical offset in points.   |

***

### create

Create a new offset.

```php
public static create(float $x, float $y): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type      | Description            |
|-----------|-----------|------------------------|
| `$x`      | **float** | The horizontal offset. |
| `$y`      | **float** | The vertical offset.   |

**Return Value:**

A new instance.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array{x: float, y: float}
```

***
