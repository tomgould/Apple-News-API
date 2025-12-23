
Style for table columns.

***

* Full name: `\TomGould\AppleNews\Document\Styles\TableColumnStyle`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/tablecolumnstyle

## Properties

### backgroundColor

The background color.

```php
private ?string $backgroundColor
```

***

### divider

The column divider.

```php
private ?\TomGould\AppleNews\Document\Styles\TableStrokeStyle $divider
```

***

### width

The column width.

```php
private ?int $width
```

***

### minimumWidth

The minimum column width.

```php
private ?int $minimumWidth
```

***

### maximumWidth

The maximum column width.

```php
private ?int $maximumWidth
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

### setDivider

Set the column divider.

```php
public setDivider(\TomGould\AppleNews\Document\Styles\TableStrokeStyle $divider): $this
```

**Parameters:**

| Parameter  | Type                                                     | Description         |
|------------|----------------------------------------------------------|---------------------|
| `$divider` | **\TomGould\AppleNews\Document\Styles\TableStrokeStyle** | The divider stroke. |

***

### setWidth

Set the column width.

```php
public setWidth(int $width): $this
```

**Parameters:**

| Parameter | Type    | Description          |
|-----------|---------|----------------------|
| `$width`  | **int** | The width in points. |

***

### setMinimumWidth

Set the minimum column width.

```php
public setMinimumWidth(int $width): $this
```

**Parameters:**

| Parameter | Type    | Description                  |
|-----------|---------|------------------------------|
| `$width`  | **int** | The minimum width in points. |

***

### setMaximumWidth

Set the maximum column width.

```php
public setMaximumWidth(int $width): $this
```

**Parameters:**

| Parameter | Type    | Description                  |
|-----------|---------|------------------------------|
| `$width`  | **int** | The maximum width in points. |

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
