
Conditional text style for component text.

Alias for ConditionalTextStyle, used in component textStyle contexts.

***

* Full name: `\TomGould\AppleNews\Document\Conditionals\ConditionalComponentTextStyle`
* Parent class: [`\TomGould\AppleNews\Document\Conditionals\ConditionalTextStyle`](./ConditionalTextStyle.md)
* This class is marked as **final** and can't be subclassed
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/conditionalcomponenttextstyle

## Inherited methods

### addCondition

Add a condition.

```php
public addCondition(\TomGould\AppleNews\Document\Layouts\Condition $condition): $this
```

**Parameters:**

| Parameter    | Type                                               | Description           |
|--------------|----------------------------------------------------|-----------------------|
| `$condition` | **\TomGould\AppleNews\Document\Layouts\Condition** | The condition to add. |

***

### setTextColor

Set the text color.

```php
public setTextColor(string $color): $this
```

**Parameters:**

| Parameter | Type       | Description              |
|-----------|------------|--------------------------|
| `$color`  | **string** | The color in hex format. |

***

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

### setFontName

Set the font name.

```php
public setFontName(string $fontName): $this
```

**Parameters:**

| Parameter   | Type       | Description    |
|-------------|------------|----------------|
| `$fontName` | **string** | The font name. |

***

### setFontSize

Set the font size.

```php
public setFontSize(int $size): $this
```

**Parameters:**

| Parameter | Type    | Description         |
|-----------|---------|---------------------|
| `$size`   | **int** | The size in points. |

***

### setFontWeight

Set the font weight.

```php
public setFontWeight(int $weight): $this
```

**Parameters:**

| Parameter | Type    | Description           |
|-----------|---------|-----------------------|
| `$weight` | **int** | The weight (100-900). |

***

### setFontWidth

Set the font width.

```php
public setFontWidth(string $width): $this
```

**Parameters:**

| Parameter | Type       | Description      |
|-----------|------------|------------------|
| `$width`  | **string** | The width value. |

***

### setFontStyle

Set the font style.

```php
public setFontStyle(string $style): $this
```

**Parameters:**

| Parameter | Type       | Description                                |
|-----------|------------|--------------------------------------------|
| `$style`  | **string** | The style ('normal', 'italic', 'oblique'). |

***

### setLineHeight

Set the line height.

```php
public setLineHeight(float $height): $this
```

**Parameters:**

| Parameter | Type      | Description                |
|-----------|-----------|----------------------------|
| `$height` | **float** | The line height in points. |

***

### setTracking

Set the tracking (letter spacing).

```php
public setTracking(float $tracking): $this
```

**Parameters:**

| Parameter   | Type      | Description         |
|-------------|-----------|---------------------|
| `$tracking` | **float** | The tracking value. |

***

### setTextAlignment

Set the text alignment.

```php
public setTextAlignment(string $alignment): $this
```

**Parameters:**

| Parameter    | Type       | Description                                    |
|--------------|------------|------------------------------------------------|
| `$alignment` | **string** | One of 'left', 'center', 'right', 'justified'. |

***

### setTextShadow

Set the text shadow.

```php
public setTextShadow(array<string,mixed> $shadow): $this
```

**Parameters:**

| Parameter | Type                    | Description               |
|-----------|-------------------------|---------------------------|
| `$shadow` | **array<string,mixed>** | The shadow configuration. |

***

### darkMode

Create a dark mode text style.

```php
public static darkMode(string $textColor): self
```

* This method is **static**.
**Parameters:**

| Parameter    | Type       | Description               |
|--------------|------------|---------------------------|
| `$textColor` | **string** | The dark mode text color. |

**Return Value:**

A new instance.

***

### lightMode

Create a light mode text style.

```php
public static lightMode(string $textColor): self
```

* This method is **static**.
**Parameters:**

| Parameter    | Type       | Description                |
|--------------|------------|----------------------------|
| `$textColor` | **string** | The light mode text color. |

**Return Value:**

A new instance.

***

### compactSize

Create a smaller text style for compact screens.

```php
public static compactSize(int $fontSize): self
```

* This method is **static**.
**Parameters:**

| Parameter   | Type    | Description            |
|-------------|---------|------------------------|
| `$fontSize` | **int** | The smaller font size. |

**Return Value:**

A new instance.

***

### hasConditions

Check if any conditions have been set.

```php
public hasConditions(): bool
```

**Return Value:**

True if conditions exist.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
