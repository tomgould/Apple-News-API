
Style for table cells.

***

* Full name: `\TomGould\AppleNews\Document\Styles\TableCellStyle`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/tablecellstyle

## Properties

### backgroundColor

The background color.

```php
private ?string $backgroundColor
```

***

### border

The border configuration.

```php
private ?\TomGould\AppleNews\Document\Styles\TableBorder $border
```

***

### minimumWidth

The minimum column width.

```php
private ?int $minimumWidth
```

***

### padding

The cell padding.

```php
private int|array<string,int>|null $padding
```

***

### textStyle

The text style reference.

```php
private ?string $textStyle
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

### width

The cell width.

```php
private ?int $width
```

***

### height

The cell height.

```php
private ?int $height
```

***

### conditional

Conditional styles.

```php
private list<array<string,mixed>>|null $conditional
```

***

## Methods

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

### setBorder

Set the border.

```php
public setBorder(\TomGould\AppleNews\Document\Styles\TableBorder $border): $this
```

**Parameters:**

| Parameter | Type                                                | Description               |
|-----------|-----------------------------------------------------|---------------------------|
| `$border` | **\TomGould\AppleNews\Document\Styles\TableBorder** | The border configuration. |

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

### setPadding

Set the padding.

```php
public setPadding(int|array<string,int> $padding): $this
```

**Parameters:**

| Parameter  | Type                       | Description  |
|------------|----------------------------|--------------|
| `$padding` | **int\|array<string,int>** | The padding. |

***

### setTextStyle

Set the text style reference.

```php
public setTextStyle(string $textStyle): $this
```

**Parameters:**

| Parameter    | Type       | Description          |
|--------------|------------|----------------------|
| `$textStyle` | **string** | The text style name. |

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

### setWidth

Set the width.

```php
public setWidth(int $width): $this
```

**Parameters:**

| Parameter | Type    | Description          |
|-----------|---------|----------------------|
| `$width`  | **int** | The width in points. |

***

### setHeight

Set the height.

```php
public setHeight(int $height): $this
```

**Parameters:**

| Parameter | Type    | Description           |
|-----------|---------|-----------------------|
| `$height` | **int** | The height in points. |

***

### setConditional

Set conditional styles.

```php
public setConditional(list<array<string,mixed>> $conditional): $this
```

**Parameters:**

| Parameter      | Type                          | Description             |
|----------------|-------------------------------|-------------------------|
| `$conditional` | **list<array<string,mixed>>** | The conditional styles. |

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
