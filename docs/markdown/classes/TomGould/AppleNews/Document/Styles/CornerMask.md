
Rounded corner clipping for components.

***

* Full name: `\TomGould\AppleNews\Document\Styles\CornerMask`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/cornermask

## Constants

| Constant       | Visibility | Type | Value     |
|----------------|------------|------|-----------|
| `TYPE_CORNERS` | public     |      | 'corners' |

## Properties

### type

The mask type.

```php
private string $type
```

***

### radius

The corner radius.

```php
private ?int $radius
```

***

### topLeft

Whether to mask top-left corner.

```php
private ?bool $topLeft
```

***

### topRight

Whether to mask top-right corner.

```php
private ?bool $topRight
```

***

### bottomLeft

Whether to mask bottom-left corner.

```php
private ?bool $bottomLeft
```

***

### bottomRight

Whether to mask bottom-right corner.

```php
private ?bool $bottomRight
```

***

## Methods

### setRadius

Set the corner radius.

```php
public setRadius(int $radius): $this
```

**Parameters:**

| Parameter | Type    | Description           |
|-----------|---------|-----------------------|
| `$radius` | **int** | The radius in points. |

***

### setCorners

Set which corners to mask.

```php
public setCorners(bool $topLeft = true, bool $topRight = true, bool $bottomLeft = true, bool $bottomRight = true): $this
```

**Parameters:**

| Parameter      | Type     | Description                    |
|----------------|----------|--------------------------------|
| `$topLeft`     | **bool** | Whether to round top-left.     |
| `$topRight`    | **bool** | Whether to round top-right.    |
| `$bottomLeft`  | **bool** | Whether to round bottom-left.  |
| `$bottomRight` | **bool** | Whether to round bottom-right. |

***

### uniform

Create a uniform corner mask.

```php
public static uniform(int $radius): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type    | Description        |
|-----------|---------|--------------------|
| `$radius` | **int** | The corner radius. |

**Return Value:**

A new instance.

***

### topOnly

Create a top corners only mask.

```php
public static topOnly(int $radius): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type    | Description        |
|-----------|---------|--------------------|
| `$radius` | **int** | The corner radius. |

**Return Value:**

A new instance.

***

### bottomOnly

Create a bottom corners only mask.

```php
public static bottomOnly(int $radius): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type    | Description        |
|-----------|---------|--------------------|
| `$radius` | **int** | The corner radius. |

**Return Value:**

A new instance.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
