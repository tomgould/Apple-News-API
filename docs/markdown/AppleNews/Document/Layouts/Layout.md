
Defines the column system and base grid for an article.

Every Apple News article requires a layout object to determine how components
are positioned relative to the grid columns.

***

* Full name: `\TomGould\AppleNews\Document\Layouts\Layout`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/applenewsformat/layout

## Properties

### margin

```php
private int|null $margin
```

***

### gutter

```php
private int|null $gutter
```

***

### columns

```php
private int $columns
```

***

### width

```php
private int $width
```

***

## Methods

### __construct

```php
public __construct(int $columns, int $width): mixed
```

**Parameters:**

| Parameter  | Type    | Description                           |
|------------|---------|---------------------------------------|
| `$columns` | **int** | Total number of columns in the grid.  |
| `$width`   | **int** | Total width of the article in points. |

***

### setMargin

Set the horizontal margin for the article content.

```php
public setMargin(int $margin): self
```

**Parameters:**

| Parameter | Type    | Description |
|-----------|---------|-------------|
| `$margin` | **int** |             |

***

### setGutter

Set the space (gutter) between columns.

```php
public setGutter(int $gutter): self
```

**Parameters:**

| Parameter | Type    | Description |
|-----------|---------|-------------|
| `$gutter` | **int** |             |

***

### jsonSerialize

```php
public jsonSerialize(): array<string,mixed>
```

***
