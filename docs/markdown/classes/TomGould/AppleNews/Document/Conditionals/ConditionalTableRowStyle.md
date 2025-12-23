
Conditional properties for table row styles.

Allows table row appearance to change based on conditions.

***

* Full name: `\TomGould\AppleNews\Document\Conditionals\ConditionalTableRowStyle`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Conditionals\ConditionalInterface`](./ConditionalInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/conditionaltablerowstyle

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

### height

The row height.

```php
private ?int $height
```

***

### divider

The divider configuration.

```php
private array<string,mixed>|null $divider
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

### setHeight

Set the row height.

```php
public setHeight(int $height): $this
```

**Parameters:**

| Parameter | Type    | Description           |
|-----------|---------|-----------------------|
| `$height` | **int** | The height in points. |

***

### setDivider

Set the divider configuration.

```php
public setDivider(array<string,mixed> $divider): $this
```

**Parameters:**

| Parameter  | Type                    | Description                |
|------------|-------------------------|----------------------------|
| `$divider` | **array<string,mixed>** | The divider configuration. |

***

### darkMode

Create a dark mode row style.

```php
public static darkMode(string $backgroundColor): self
```

* This method is **static**.
**Parameters:**

| Parameter          | Type       | Description               |
|--------------------|------------|---------------------------|
| `$backgroundColor` | **string** | The dark mode background. |

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
