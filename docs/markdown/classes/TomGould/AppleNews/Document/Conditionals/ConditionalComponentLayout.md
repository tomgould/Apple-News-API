
Conditional properties for component layouts.

Allows layout properties like margin, padding, and column span
to change based on conditions.

***

* Full name: `\TomGould\AppleNews\Document\Conditionals\ConditionalComponentLayout`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Conditionals\ConditionalInterface`](./ConditionalInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/conditionalcomponentlayout

## Properties

### conditions

The conditions that must be met.

```php
private list<\TomGould\AppleNews\Document\Layouts\Condition> $conditions
```

***

### columnStart

The column start position.

```php
private ?int $columnStart
```

***

### columnSpan

The column span.

```php
private ?int $columnSpan
```

***

### margin

The margin configuration.

```php
private int|array<string,mixed>|null $margin
```

***

### contentInset

The content inset.

```php
private int|array<string,mixed>|null $contentInset
```

***

### padding

The padding.

```php
private int|array<string,mixed>|null $padding
```

***

### minimumHeight

The minimum height.

```php
private int|string|null $minimumHeight
```

***

### maximumWidth

The maximum width.

```php
private int|string|null $maximumWidth
```

***

### minimumWidth

The minimum width.

```php
private int|string|null $minimumWidth
```

***

### horizontalContentAlignment

The horizontal content alignment.

```php
private ?string $horizontalContentAlignment
```

***

### ignoreDocumentMargin

Whether to ignore document margin.

```php
private ?bool $ignoreDocumentMargin
```

***

### ignoreDocumentGutter

Whether to ignore document gutter.

```php
private ?bool $ignoreDocumentGutter
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

### setColumnStart

Set the column start.

```php
public setColumnStart(int $columnStart): $this
```

**Parameters:**

| Parameter      | Type    | Description          |
|----------------|---------|----------------------|
| `$columnStart` | **int** | The starting column. |

***

### setColumnSpan

Set the column span.

```php
public setColumnSpan(int $columnSpan): $this
```

**Parameters:**

| Parameter     | Type    | Description                |
|---------------|---------|----------------------------|
| `$columnSpan` | **int** | Number of columns to span. |

***

### setMargin

Set the margin.

```php
public setMargin(int|array<string,mixed> $margin): $this
```

**Parameters:**

| Parameter | Type                         | Description                        |
|-----------|------------------------------|------------------------------------|
| `$margin` | **int\|array<string,mixed>** | The margin value or configuration. |

***

### setContentInset

Set the content inset.

```php
public setContentInset(int|array<string,mixed> $inset): $this
```

**Parameters:**

| Parameter | Type                         | Description                       |
|-----------|------------------------------|-----------------------------------|
| `$inset`  | **int\|array<string,mixed>** | The inset value or configuration. |

***

### setPadding

Set the padding.

```php
public setPadding(int|array<string,mixed> $padding): $this
```

**Parameters:**

| Parameter  | Type                         | Description                         |
|------------|------------------------------|-------------------------------------|
| `$padding` | **int\|array<string,mixed>** | The padding value or configuration. |

***

### setMinimumHeight

Set the minimum height.

```php
public setMinimumHeight(int|string $height): $this
```

**Parameters:**

| Parameter | Type            | Description         |
|-----------|-----------------|---------------------|
| `$height` | **int\|string** | The minimum height. |

***

### setMaximumWidth

Set the maximum width.

```php
public setMaximumWidth(int|string $width): $this
```

**Parameters:**

| Parameter | Type            | Description        |
|-----------|-----------------|--------------------|
| `$width`  | **int\|string** | The maximum width. |

***

### setMinimumWidth

Set the minimum width.

```php
public setMinimumWidth(int|string $width): $this
```

**Parameters:**

| Parameter | Type            | Description        |
|-----------|-----------------|--------------------|
| `$width`  | **int\|string** | The minimum width. |

***

### setHorizontalContentAlignment

Set the horizontal content alignment.

```php
public setHorizontalContentAlignment(string $alignment): $this
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$alignment` | **string** | One of 'left', 'center', 'right'. |

***

### setIgnoreDocumentMargin

Set whether to ignore document margin.

```php
public setIgnoreDocumentMargin(bool $ignore): $this
```

**Parameters:**

| Parameter | Type     | Description        |
|-----------|----------|--------------------|
| `$ignore` | **bool** | Whether to ignore. |

***

### setIgnoreDocumentGutter

Set whether to ignore document gutter.

```php
public setIgnoreDocumentGutter(bool $ignore): $this
```

**Parameters:**

| Parameter | Type     | Description        |
|-----------|----------|--------------------|
| `$ignore` | **bool** | Whether to ignore. |

***

### fullWidthOnCompact

Create a full-width layout for compact devices.

```php
public static fullWidthOnCompact(): self
```

* This method is **static**.
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
