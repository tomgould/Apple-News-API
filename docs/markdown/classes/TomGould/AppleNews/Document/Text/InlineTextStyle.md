
Inline text style for specific ranges within text.

***

* Full name: `\TomGould\AppleNews\Document\Text\InlineTextStyle`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/inlinetextstyle

## Properties

### textStyle

The text style (reference or inline definition).

```php
private string|array<string,mixed>|null $textStyle
```

***

### rangeStart

```php
private int $rangeStart
```

***

### rangeLength

```php
private int $rangeLength
```

***

## Methods

### __construct

Create a new InlineTextStyle.

```php
public __construct(int $rangeStart, int $rangeLength): mixed
```

**Parameters:**

| Parameter      | Type    | Description              |
|----------------|---------|--------------------------|
| `$rangeStart`  | **int** | The starting position.   |
| `$rangeLength` | **int** | The length of the range. |

***

### forRange

Create an inline style for a range.

```php
public static forRange(int $start, int $length): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type    | Description            |
|-----------|---------|------------------------|
| `$start`  | **int** | The starting position. |
| `$length` | **int** | The length.            |

**Return Value:**

A new instance.

***

### withStyle

Set the text style reference.

```php
public withStyle(string $styleName): $this
```

**Parameters:**

| Parameter    | Type       | Description          |
|--------------|------------|----------------------|
| `$styleName` | **string** | The text style name. |

***

### withInlineStyle

Set an inline text style definition.

```php
public withInlineStyle(array<string,mixed> $style): $this
```

**Parameters:**

| Parameter | Type                    | Description           |
|-----------|-------------------------|-----------------------|
| `$style`  | **array<string,mixed>** | The style definition. |

***

### bold

Create a bold style for a range.

```php
public static bold(int $start, int $length): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type    | Description            |
|-----------|---------|------------------------|
| `$start`  | **int** | The starting position. |
| `$length` | **int** | The length.            |

**Return Value:**

A new instance.

***

### italic

Create an italic style for a range.

```php
public static italic(int $start, int $length): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type    | Description            |
|-----------|---------|------------------------|
| `$start`  | **int** | The starting position. |
| `$length` | **int** | The length.            |

**Return Value:**

A new instance.

***

### colored

Create a colored text style for a range.

```php
public static colored(int $start, int $length, string $color): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description            |
|-----------|------------|------------------------|
| `$start`  | **int**    | The starting position. |
| `$length` | **int**    | The length.            |
| `$color`  | **string** | The text color.        |

**Return Value:**

A new instance.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
