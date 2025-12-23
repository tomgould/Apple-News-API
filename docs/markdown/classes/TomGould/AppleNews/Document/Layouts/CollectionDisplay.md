
Collection display for grid-like component arrangements.

The collection display arranges child components in a flexible grid,
with control over alignment, distribution, and spacing.

***

* Full name: `\TomGould\AppleNews\Document\Layouts\CollectionDisplay`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Layouts\ContentDisplayInterface`](./ContentDisplayInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/collectiondisplay

## Constants

| Constant            | Visibility | Type | Value    |
|---------------------|------------|------|----------|
| `ALIGN_LEFT`        | public     |      | 'left'   |
| `ALIGN_CENTER`      | public     |      | 'center' |
| `ALIGN_RIGHT`       | public     |      | 'right'  |
| `DISTRIBUTE_WIDE`   | public     |      | 'wide'   |
| `DISTRIBUTE_NARROW` | public     |      | 'narrow' |

## Properties

### alignment

Horizontal alignment of components.

```php
private ?string $alignment
```

***

### distribution

Distribution of components across columns.

```php
private ?string $distribution
```

***

### rowSpacing

Spacing between rows in points.

```php
private ?int $rowSpacing
```

***

### gutter

Spacing between columns in points.

```php
private ?int $gutter
```

***

### variableSizing

Whether to vary column widths for visual interest.

```php
private ?bool $variableSizing
```

***

### widths

The width of each item as a column count.

```php
private ?int $widths
```

***

### minimumWidth

The minimum width of each item in points.

```php
private ?int $minimumWidth
```

***

### maximumWidth

The maximum width of each item in points.

```php
private ?int $maximumWidth
```

***

## Methods

### getType

Get the content display type identifier.

```php
public getType(): string
```

**Return Value:**

The display type (e.g., 'horizontal_stack', 'collection').

***

### setAlignment

Set the horizontal alignment.

```php
public setAlignment(string $alignment): $this
```

**Parameters:**

| Parameter    | Type       | Description                       |
|--------------|------------|-----------------------------------|
| `$alignment` | **string** | One of 'left', 'center', 'right'. |

***

### setDistribution

Set the distribution.

```php
public setDistribution(string $distribution): $this
```

**Parameters:**

| Parameter       | Type       | Description              |
|-----------------|------------|--------------------------|
| `$distribution` | **string** | One of 'wide', 'narrow'. |

***

### setRowSpacing

Set the row spacing in points.

```php
public setRowSpacing(int $spacing): $this
```

**Parameters:**

| Parameter  | Type    | Description           |
|------------|---------|-----------------------|
| `$spacing` | **int** | Spacing between rows. |

***

### setGutter

Set the gutter (column spacing) in points.

```php
public setGutter(int $gutter): $this
```

**Parameters:**

| Parameter | Type    | Description              |
|-----------|---------|--------------------------|
| `$gutter` | **int** | Spacing between columns. |

***

### setVariableSizing

Set whether to use variable sizing.

```php
public setVariableSizing(bool $variable): $this
```

**Parameters:**

| Parameter   | Type     | Description                    |
|-------------|----------|--------------------------------|
| `$variable` | **bool** | Whether to vary column widths. |

***

### setWidths

Set the item widths as column count.

```php
public setWidths(int $widths): $this
```

**Parameters:**

| Parameter | Type    | Description                        |
|-----------|---------|------------------------------------|
| `$widths` | **int** | Number of columns each item spans. |

***

### setMinimumWidth

Set the minimum item width in points.

```php
public setMinimumWidth(int $width): $this
```

**Parameters:**

| Parameter | Type    | Description    |
|-----------|---------|----------------|
| `$width`  | **int** | Minimum width. |

***

### setMaximumWidth

Set the maximum item width in points.

```php
public setMaximumWidth(int $width): $this
```

**Parameters:**

| Parameter | Type    | Description    |
|-----------|---------|----------------|
| `$width`  | **int** | Maximum width. |

***

### centered

Create a centered collection display.

```php
public static centered(): self
```

* This method is **static**.
**Return Value:**

A new CollectionDisplay instance.

***

### grid

Create a grid-like collection with specified spacing.

```php
public static grid(int $gutter = 20, int $rowSpacing = 20): self
```

* This method is **static**.
**Parameters:**

| Parameter     | Type    | Description               |
|---------------|---------|---------------------------|
| `$gutter`     | **int** | Column spacing in points. |
| `$rowSpacing` | **int** | Row spacing in points.    |

**Return Value:**

A new CollectionDisplay instance.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
