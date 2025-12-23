
Overall table style configuration.

***

* Full name: `\TomGould\AppleNews\Document\Styles\TableStyle`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/tablestyle

## Properties

### cells

The default cell style.

```php
private ?\TomGould\AppleNews\Document\Styles\TableCellStyle $cells
```

***

### columns

The default column style.

```php
private ?\TomGould\AppleNews\Document\Styles\TableColumnStyle $columns
```

***

### headerCells

The header cell style.

```php
private ?\TomGould\AppleNews\Document\Styles\TableCellStyle $headerCells
```

***

### headerColumns

The header column style.

```php
private ?\TomGould\AppleNews\Document\Styles\TableColumnStyle $headerColumns
```

***

### headerRows

The header row style.

```php
private ?\TomGould\AppleNews\Document\Styles\TableRowStyle $headerRows
```

***

### rows

The default row style.

```php
private ?\TomGould\AppleNews\Document\Styles\TableRowStyle $rows
```

***

### conditional

Conditional styles.

```php
private list<array<string,mixed>>|null $conditional
```

***

## Methods

### setCells

Set the default cell style.

```php
public setCells(\TomGould\AppleNews\Document\Styles\TableCellStyle $style): $this
```

**Parameters:**

| Parameter | Type                                                   | Description     |
|-----------|--------------------------------------------------------|-----------------|
| `$style`  | **\TomGould\AppleNews\Document\Styles\TableCellStyle** | The cell style. |

***

### setColumns

Set the default column style.

```php
public setColumns(\TomGould\AppleNews\Document\Styles\TableColumnStyle $style): $this
```

**Parameters:**

| Parameter | Type                                                     | Description       |
|-----------|----------------------------------------------------------|-------------------|
| `$style`  | **\TomGould\AppleNews\Document\Styles\TableColumnStyle** | The column style. |

***

### setHeaderCells

Set the header cell style.

```php
public setHeaderCells(\TomGould\AppleNews\Document\Styles\TableCellStyle $style): $this
```

**Parameters:**

| Parameter | Type                                                   | Description     |
|-----------|--------------------------------------------------------|-----------------|
| `$style`  | **\TomGould\AppleNews\Document\Styles\TableCellStyle** | The cell style. |

***

### setHeaderColumns

Set the header column style.

```php
public setHeaderColumns(\TomGould\AppleNews\Document\Styles\TableColumnStyle $style): $this
```

**Parameters:**

| Parameter | Type                                                     | Description       |
|-----------|----------------------------------------------------------|-------------------|
| `$style`  | **\TomGould\AppleNews\Document\Styles\TableColumnStyle** | The column style. |

***

### setHeaderRows

Set the header row style.

```php
public setHeaderRows(\TomGould\AppleNews\Document\Styles\TableRowStyle $style): $this
```

**Parameters:**

| Parameter | Type                                                  | Description    |
|-----------|-------------------------------------------------------|----------------|
| `$style`  | **\TomGould\AppleNews\Document\Styles\TableRowStyle** | The row style. |

***

### setRows

Set the default row style.

```php
public setRows(\TomGould\AppleNews\Document\Styles\TableRowStyle $style): $this
```

**Parameters:**

| Parameter | Type                                                  | Description    |
|-----------|-------------------------------------------------------|----------------|
| `$style`  | **\TomGould\AppleNews\Document\Styles\TableRowStyle** | The row style. |

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
