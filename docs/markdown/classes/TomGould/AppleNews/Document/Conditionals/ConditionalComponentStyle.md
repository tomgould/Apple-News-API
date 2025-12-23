
Conditional properties for component styles.

Allows style properties like backgroundColor, border, and opacity
to change based on conditions.

***

* Full name: `\TomGould\AppleNews\Document\Conditionals\ConditionalComponentStyle`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Conditionals\ConditionalInterface`](./ConditionalInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/conditionalcomponentstyle

## Properties

### conditions

The conditions that must be met.

```php
private list<\TomGould\AppleNews\Document\Layouts\Condition> $conditions
```

***

### backgroundColor

The background color.

```php
private ?string $backgroundColor
```

***

### fill

The fill configuration.

```php
private array<string,mixed>|null $fill
```

***

### border

The border configuration.

```php
private array<string,mixed>|null $border
```

***

### shadow

The shadow configuration.

```php
private array<string,mixed>|null $shadow
```

***

### opacity

The opacity (0.0 to 1.0).

```php
private ?float $opacity
```

***

### mask

The mask configuration.

```php
private array<string,mixed>|null $mask
```

***

## Methods

### addCondition

Add a condition.

```php
public addCondition(\TomGould\AppleNews\Document\Layouts\Condition $condition): $this
```

**Parameters:**

| Parameter    | Type                                               | Description           |
|--------------|----------------------------------------------------|-----------------------|
| `$condition` | **\TomGould\AppleNews\Document\Layouts\Condition** | The condition to add. |

***

### setBackgroundColor

Set the background color.

```php
public setBackgroundColor(string $color): $this
```

**Parameters:**

| Parameter | Type       | Description              |
|-----------|------------|--------------------------|
| `$color`  | **string** | The color in hex format. |

***

### setFill

Set the fill configuration.

```php
public setFill(array<string,mixed> $fill): $this
```

**Parameters:**

| Parameter | Type                    | Description             |
|-----------|-------------------------|-------------------------|
| `$fill`   | **array<string,mixed>** | The fill configuration. |

***

### setBorder

Set the border configuration.

```php
public setBorder(array<string,mixed> $border): $this
```

**Parameters:**

| Parameter | Type                    | Description               |
|-----------|-------------------------|---------------------------|
| `$border` | **array<string,mixed>** | The border configuration. |

***

### setShadow

Set the shadow configuration.

```php
public setShadow(array<string,mixed> $shadow): $this
```

**Parameters:**

| Parameter | Type                    | Description               |
|-----------|-------------------------|---------------------------|
| `$shadow` | **array<string,mixed>** | The shadow configuration. |

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

### setMask

Set the mask configuration.

```php
public setMask(array<string,mixed> $mask): $this
```

**Parameters:**

| Parameter | Type                    | Description             |
|-----------|-------------------------|-------------------------|
| `$mask`   | **array<string,mixed>** | The mask configuration. |

***

### darkMode

Create a dark mode style.

```php
public static darkMode(string $backgroundColor): self
```

* This method is **static**.
**Parameters:**

| Parameter          | Type       | Description                     |
|--------------------|------------|---------------------------------|
| `$backgroundColor` | **string** | The dark mode background color. |

**Return Value:**

A new instance.

***

### lightMode

Create a light mode style.

```php
public static lightMode(string $backgroundColor): self
```

* This method is **static**.
**Parameters:**

| Parameter          | Type       | Description                      |
|--------------------|------------|----------------------------------|
| `$backgroundColor` | **string** | The light mode background color. |

**Return Value:**

A new instance.

***

### hasConditions

Check if any conditions have been set.

```php
public hasConditions(): bool
```

**Return Value:**

True if conditions exist.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
