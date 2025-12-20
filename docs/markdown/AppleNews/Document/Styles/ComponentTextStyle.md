
Detailed text styling options for components.

This class controls typography including fonts, colors, spacing, and alignment.

***

* Full name: `\TomGould\AppleNews\Document\Styles\ComponentTextStyle`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/applenewsformat/componenttextstyle

## Properties

### fontName

```php
private ?string $fontName
```

***

### fontSize

```php
private ?int $fontSize
```

***

### textColor

```php
private ?string $textColor
```

***

### textAlignment

```php
private ?string $textAlignment
```

***

### lineHeight

```php
private ?float $lineHeight
```

***

### tracking

```php
private ?float $tracking
```

***

### hyphenation

```php
private ?bool $hyphenation
```

***

### fontWeight

```php
private ?string $fontWeight
```

***

### fontStyle

```php
private ?string $fontStyle
```

***

### textDecoration

```php
private ?string $textDecoration
```

***

### textTransform

```php
private ?string $textTransform
```

***

### linkStyle

```php
private array<string,mixed>|null $linkStyle
```

***

### dropCapStyle

```php
private array<string,mixed>|null $dropCapStyle
```

***

### backgroundColor

```php
private ?string $backgroundColor
```

***

### textShadow

```php
private array<string,mixed>|null $textShadow
```

***

### paragraphSpacingBefore

```php
private ?int $paragraphSpacingBefore
```

***

### paragraphSpacingAfter

```php
private ?int $paragraphSpacingAfter
```

***

### firstLineIndent

```php
private ?int $firstLineIndent
```

***

### hangingPunctuation

```php
private ?int $hangingPunctuation
```

***

## Methods

### setFontName

Set the font family name.

```php
public setFontName(string $fontName): self
```

**Parameters:**

| Parameter   | Type       | Description |
|-------------|------------|-------------|
| `$fontName` | **string** |             |

***

### setFontSize

Set the font size in points.

```php
public setFontSize(int $fontSize): self
```

**Parameters:**

| Parameter   | Type    | Description |
|-------------|---------|-------------|
| `$fontSize` | **int** |             |

***

### setTextColor

Set the text color.

```php
public setTextColor(string $color): self
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$color`  | **string** |             |

***

### setTextAlignment

Set text alignment (left, center, right, justify).

```php
public setTextAlignment(string $alignment): self
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$alignment` | **string** |             |

***

### setLineHeight

Set the line height in points.

```php
public setLineHeight(float $lineHeight): self
```

**Parameters:**

| Parameter     | Type      | Description |
|---------------|-----------|-------------|
| `$lineHeight` | **float** |             |

***

### setTracking

Set letter spacing (tracking).

```php
public setTracking(float $tracking): self
```

**Parameters:**

| Parameter   | Type      | Description |
|-------------|-----------|-------------|
| `$tracking` | **float** |             |

***

### setHyphenation

Enable or disable automatic hyphenation.

```php
public setHyphenation(bool $hyphenation): self
```

**Parameters:**

| Parameter      | Type     | Description |
|----------------|----------|-------------|
| `$hyphenation` | **bool** |             |

***

### setFontWeight

Set font weight (e.g., "bold", "100").

```php
public setFontWeight(string $weight): self
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$weight` | **string** |             |

***

### setFontStyle

Set font style (normal, italic).

```php
public setFontStyle(string $style): self
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$style`  | **string** |             |

***

### setTextDecoration

Set text decoration (underline, line-through).

```php
public setTextDecoration(string $decoration): self
```

**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$decoration` | **string** |             |

***

### setTextTransform

Set text transform (uppercase, lowercase, capitalize).

```php
public setTextTransform(string $transform): self
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$transform` | **string** |             |

***

### setLinkStyle

Define styles for links within the text.

```php
public setLinkStyle(array<string,mixed> $style): self
```

**Parameters:**

| Parameter | Type                    | Description |
|-----------|-------------------------|-------------|
| `$style`  | **array<string,mixed>** |             |

***

### setDropCapStyle

Define the drop cap style for the first letter.

```php
public setDropCapStyle(array<string,mixed> $style): self
```

**Parameters:**

| Parameter | Type                    | Description |
|-----------|-------------------------|-------------|
| `$style`  | **array<string,mixed>** |             |

***

### setBackgroundColor

Set background color for the text span.

```php
public setBackgroundColor(string $color): self
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$color`  | **string** |             |

***

### setTextShadow

Apply a shadow effect to the text.

```php
public setTextShadow(array<string,mixed> $shadow): self
```

**Parameters:**

| Parameter | Type                    | Description |
|-----------|-------------------------|-------------|
| `$shadow` | **array<string,mixed>** |             |

***

### setParagraphSpacingBefore

Set spacing before paragraphs.

```php
public setParagraphSpacingBefore(int $spacing): self
```

**Parameters:**

| Parameter  | Type    | Description |
|------------|---------|-------------|
| `$spacing` | **int** |             |

***

### setParagraphSpacingAfter

Set spacing after paragraphs.

```php
public setParagraphSpacingAfter(int $spacing): self
```

**Parameters:**

| Parameter  | Type    | Description |
|------------|---------|-------------|
| `$spacing` | **int** |             |

***

### setFirstLineIndent

Set the indentation of the first line.

```php
public setFirstLineIndent(int $indent): self
```

**Parameters:**

| Parameter | Type    | Description |
|-----------|---------|-------------|
| `$indent` | **int** |             |

***

### setHangingPunctuation

Control hanging punctuation (e.g., quotes outside the alignment).

```php
public setHangingPunctuation(int $value): self
```

**Parameters:**

| Parameter | Type    | Description |
|-----------|---------|-------------|
| `$value`  | **int** |             |

***

### jsonSerialize

```php
public jsonSerialize(): array<string,mixed>
```

***
