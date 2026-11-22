
Conditional properties for table cell styles.

Allows table cell appearance to change based on conditions.

***

* Full name: `\TomGould\AppleNews\Document\Conditionals\ConditionalTableCellStyle`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Conditionals\ConditionalInterface`](./ConditionalInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/conditionaltablecellstyle

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

### textColor

The text color.

```php
private ?string $textColor
```

***

### horizontalAlignment

The horizontal alignment.

```php
private ?string $horizontalAlignment
```

***

### verticalAlignment

The vertical alignment.

```php
private ?string $verticalAlignment
```

***

### padding

The padding.

```php
private int|array<string,mixed>|null $padding
```

***

### minimumWidth

The minimum width.

```php
private ?int $minimumWidth
```

***

### width

The cell width.

```php
private ?int $width
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

### setTextColor

Set the text color.

```php
public setTextColor(string $color): $this
```

**Parameters:**

| Parameter | Type       | Description              |
|-----------|------------|--------------------------|
| `$color`  | **string** | The color in hex format. |

***

### setHorizontalAlignment

Set the horizontal alignment.

```php
public setHorizontalAlignment(string $alignment): $this
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$alignment` | **string** | One of 'left', 'center', 'right'. |

***

### setVerticalAlignment

Set the vertical alignment.

```php
public setVerticalAlignment(string $alignment): $this
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$alignment` | **string** | One of 'top', 'center', 'bottom'. |

***

### setPadding

Set the padding.

```php
public setPadding(int|array<string,mixed> $padding): $this
```

**Parameters:**

| Parameter  | Type                         | Description  |
|------------|------------------------------|--------------|
| `$padding` | **int\|array<string,mixed>** | The padding. |

***

### setMinimumWidth

Set the minimum width.

```php
public setMinimumWidth(int $width): $this
```

**Parameters:**

| Parameter | Type    | Description                  |
|-----------|---------|------------------------------|
| `$width`  | **int** | The minimum width in points. |

***

### setWidth

Set the cell width.

```php
public setWidth(int $width): $this
```

**Parameters:**

| Parameter | Type    | Description          |
|-----------|---------|----------------------|
| `$width`  | **int** | The width in points. |

***

### darkMode

Create a dark mode cell style.

```php
public static darkMode(string $backgroundColor, string|null $textColor = null): self
```

* This method is **static**.
**Parameters:**

| Parameter          | Type             | Description                    |
|--------------------|------------------|--------------------------------|
| `$backgroundColor` | **string**       | The dark mode background.      |
| `$textColor`       | **string\|null** | Optional dark mode text color. |

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
