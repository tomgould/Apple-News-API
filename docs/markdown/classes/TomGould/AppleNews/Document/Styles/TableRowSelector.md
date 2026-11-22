
Selector for targeting specific table rows.

***

* Full name: `\TomGould\AppleNews\Document\Styles\TableRowSelector`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/tablerowselector

## Properties

### rowIndex

The row index.

```php
private ?int $rowIndex
```

***

### descriptor

The descriptor identifier.

```php
private ?string $descriptor
```

***

### odd

Whether to select odd rows.

```php
private ?bool $odd
```

***

### even

Whether to select even rows.

```php
private ?bool $even
```

***

## Methods

### setRowIndex

Set the row index.

```php
public setRowIndex(int $index): $this
```

**Parameters:**

| Parameter | Type    | Description    |
|-----------|---------|----------------|
| `$index`  | **int** | The row index. |

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

Set to select odd rows.

```php
public setOdd(): $this
```

***

### setEven

Set to select even rows.

```php
public setEven(): $this
```

***

### oddRows

Create a selector for odd rows.

```php
public static oddRows(): self
```

* This method is **static**.
**Return Value:**

A new instance.

***

### evenRows

Create a selector for even rows.

```php
public static evenRows(): self
```

* This method is **static**.
**Return Value:**

A new instance.

***

### row

Create a selector for a specific row.

```php
public static row(int $index): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type    | Description    |
|-----------|---------|----------------|
| `$index`  | **int** | The row index. |

**Return Value:**

A new instance.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
