
Style for table rows.

***

* Full name: `\TomGould\AppleNews\Document\Styles\TableRowStyle`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/tablerowstyle

## Properties

### backgroundColor

The background color.

```php
private ?string $backgroundColor
```

***

### divider

The row divider.

```php
private ?\TomGould\AppleNews\Document\Styles\TableStrokeStyle $divider
```

***

### height

The row height.

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

### setDivider

Set the row divider.

```php
public setDivider(\TomGould\AppleNews\Document\Styles\TableStrokeStyle $divider): $this
```

**Parameters:**

| Parameter  | Type                                                     | Description         |
|------------|----------------------------------------------------------|---------------------|
| `$divider` | **\TomGould\AppleNews\Document\Styles\TableStrokeStyle** | The divider stroke. |

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

### zebraStripe

Create a zebra stripe style for alternating rows.

```php
public static zebraStripe(string $color): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description                   |
|-----------|------------|-------------------------------|
| `$color`  | **string** | Background color for the row. |

**Return Value:**

A style configured for striped rows (use with odd/even selector).

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
