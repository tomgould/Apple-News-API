
Parallax behavior for scroll-based parallax effects.

The parallax behavior makes a component move at a different rate than
the scroll speed, creating a depth effect. The factor determines how
much slower (< 1) or faster (> 1) the component moves relative to scroll.

***

* Full name: `\TomGould\AppleNews\Document\Behaviors\Parallax`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Behaviors\BehaviorInterface`](./BehaviorInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/parallax

## Properties

### factor

```php
private float $factor
```

***

## Methods

### __construct

Create a new Parallax behavior.

```php
public __construct(float $factor = 0.9): mixed
```

**Parameters:**

| Parameter | Type      | Description                                                                                                                                                 |
|-----------|-----------|-------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `$factor` | **float** | The parallax factor. Values less than 1.0 make the component
scroll slower than the content (appearing further away).
Typical values range from 0.5 to 0.9. |

***

### withFactor

Create a Parallax with a specific factor.

```php
public static withFactor(float $factor): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type      | Description                                     |
|-----------|-----------|-------------------------------------------------|
| `$factor` | **float** | The parallax factor (0.0 to 2.0 typical range). |

**Return Value:**

A new Parallax instance.

***

### subtle

Create a subtle parallax effect.

```php
public static subtle(): self
```

* This method is **static**.
**Return Value:**

A Parallax with factor 0.9.

***

### moderate

Create a moderate parallax effect.

```php
public static moderate(): self
```

* This method is **static**.
**Return Value:**

A Parallax with factor 0.7.

***

### strong

Create a strong parallax effect.

```php
public static strong(): self
```

* This method is **static**.
**Return Value:**

A Parallax with factor 0.5.

***

### getType

Get the behavior type identifier.

```php
public getType(): string
```

**Return Value:**

The behavior type (e.g., 'parallax', 'springy').

***

### getFactor

Get the parallax factor.

```php
public getFactor(): float
```

**Return Value:**

The factor value.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array{type: string, factor: float}
```

***
