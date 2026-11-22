
Border configuration for tables.

***

* Full name: `\TomGould\AppleNews\Document\Styles\TableBorder`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/tableborder

## Properties

### all

The border for all sides.

```php
private ?\TomGould\AppleNews\Document\Styles\TableStrokeStyle $all
```

***

### top

The top border.

```php
private ?\TomGould\AppleNews\Document\Styles\TableStrokeStyle $top
```

***

### bottom

The bottom border.

```php
private ?\TomGould\AppleNews\Document\Styles\TableStrokeStyle $bottom
```

***

### left

The left border.

```php
private ?\TomGould\AppleNews\Document\Styles\TableStrokeStyle $left
```

***

### right

The right border.

```php
private ?\TomGould\AppleNews\Document\Styles\TableStrokeStyle $right
```

***

## Methods

### setAll

Set all borders.

```php
public setAll(\TomGould\AppleNews\Document\Styles\TableStrokeStyle $stroke): $this
```

**Parameters:**

| Parameter | Type                                                     | Description       |
|-----------|----------------------------------------------------------|-------------------|
| `$stroke` | **\TomGould\AppleNews\Document\Styles\TableStrokeStyle** | The stroke style. |

***

### setTop

Set the top border.

```php
public setTop(\TomGould\AppleNews\Document\Styles\TableStrokeStyle $stroke): $this
```

**Parameters:**

| Parameter | Type                                                     | Description       |
|-----------|----------------------------------------------------------|-------------------|
| `$stroke` | **\TomGould\AppleNews\Document\Styles\TableStrokeStyle** | The stroke style. |

***

### setBottom

Set the bottom border.

```php
public setBottom(\TomGould\AppleNews\Document\Styles\TableStrokeStyle $stroke): $this
```

**Parameters:**

| Parameter | Type                                                     | Description       |
|-----------|----------------------------------------------------------|-------------------|
| `$stroke` | **\TomGould\AppleNews\Document\Styles\TableStrokeStyle** | The stroke style. |

***

### setLeft

Set the left border.

```php
public setLeft(\TomGould\AppleNews\Document\Styles\TableStrokeStyle $stroke): $this
```

**Parameters:**

| Parameter | Type                                                     | Description       |
|-----------|----------------------------------------------------------|-------------------|
| `$stroke` | **\TomGould\AppleNews\Document\Styles\TableStrokeStyle** | The stroke style. |

***

### setRight

Set the right border.

```php
public setRight(\TomGould\AppleNews\Document\Styles\TableStrokeStyle $stroke): $this
```

**Parameters:**

| Parameter | Type                                                     | Description       |
|-----------|----------------------------------------------------------|-------------------|
| `$stroke` | **\TomGould\AppleNews\Document\Styles\TableStrokeStyle** | The stroke style. |

***

### uniform

Create a uniform border.

```php
public static uniform(string $color, int $width = 1): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description       |
|-----------|------------|-------------------|
| `$color`  | **string** | The border color. |
| `$width`  | **int**    | The border width. |

**Return Value:**

A new instance.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
