
Selector for targeting specific table columns.

***

* Full name: `\TomGould\AppleNews\Document\Styles\TableColumnSelector`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/tablecolumnselector

## Properties

### columnIndex

The column index.

```php
private ?int $columnIndex
```

***

### descriptor

The descriptor identifier.

```php
private ?string $descriptor
```

***

### odd

Whether to select odd columns.

```php
private ?bool $odd
```

***

### even

Whether to select even columns.

```php
private ?bool $even
```

***

## Methods

### setColumnIndex

Set the column index.

```php
public setColumnIndex(int $index): $this
```

**Parameters:**

| Parameter | Type    | Description       |
|-----------|---------|-------------------|
| `$index`  | **int** | The column index. |

***

### setDescriptor

Set the descriptor identifier.

```php
public setDescriptor(string $descriptor): $this
```

**Parameters:**

| Parameter     | Type       | Description        |
|---------------|------------|--------------------|
| `$descriptor` | **string** | The descriptor ID. |

***

### setOdd

Set to select odd columns.

```php
public setOdd(): $this
```

***

### setEven

Set to select even columns.

```php
public setEven(): $this
```

***

### oddColumns

Create a selector for odd columns.

```php
public static oddColumns(): self
```

* This method is **static**.
**Return Value:**

A new instance.

***

### evenColumns

Create a selector for even columns.

```php
public static evenColumns(): self
```

* This method is **static**.
**Return Value:**

A new instance.

***

### column

Create a selector for a specific column.

```php
public static column(int $index): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type    | Description       |
|-----------|---------|-------------------|
| `$index`  | **int** | The column index. |

**Return Value:**

A new instance.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
