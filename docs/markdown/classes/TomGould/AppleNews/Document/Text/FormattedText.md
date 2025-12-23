
Formatted text with styling support.

Used for complex text content that requires inline styling,
additions, or specific formatting.

***

* Full name: `\TomGould\AppleNews\Document\Text\FormattedText`
* This class is marked as **final** and can't be subclassed
* This class implements:
  `JsonSerializable`
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/formattedtext

## Constants

| Constant          | Visibility | Type | Value      |
|-------------------|------------|------|------------|
| `FORMAT_HTML`     | public     |      | 'html'     |
| `FORMAT_MARKDOWN` | public     |      | 'markdown' |
| `FORMAT_NONE`     | public     |      | 'none'     |

## Properties

### format

The text format.

```php
private ?string $format
```

***

### textStyle

The text style reference.

```php
private ?string $textStyle
```

***

### inlineTextStyles

Inline text styles.

```php
private list<array<string,mixed>>|null $inlineTextStyles
```

***

### additions

Additions (links, etc.).

```php
private list<\TomGould\AppleNews\Document\Additions\AdditionInterface>|null $additions
```

***

### text

```php
private string $text
```

***

## Methods

### __construct

Create a new FormattedText.

```php
public __construct(string $text): mixed
```

**Parameters:**

| Parameter | Type       | Description       |
|-----------|------------|-------------------|
| `$text`   | **string** | The text content. |

***

### plain

Create formatted text from plain text.

```php
public static plain(string $text): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description       |
|-----------|------------|-------------------|
| `$text`   | **string** | The text content. |

**Return Value:**

A new instance.

***

### html

Create formatted text from HTML.

```php
public static html(string $html): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description       |
|-----------|------------|-------------------|
| `$html`   | **string** | The HTML content. |

**Return Value:**

A new instance.

***

### markdown

Create formatted text from Markdown.

```php
public static markdown(string $markdown): self
```

* This method is **static**.
**Parameters:**

| Parameter   | Type       | Description           |
|-------------|------------|-----------------------|
| `$markdown` | **string** | The Markdown content. |

**Return Value:**

A new instance.

***

### setFormat

Set the text format.

```php
public setFormat(string $format): $this
```

**Parameters:**

| Parameter | Type       | Description                        |
|-----------|------------|------------------------------------|
| `$format` | **string** | One of 'html', 'markdown', 'none'. |

***

### setTextStyle

Set the text style reference.

```php
public setTextStyle(string $textStyle): $this
```

**Parameters:**

| Parameter    | Type       | Description          |
|--------------|------------|----------------------|
| `$textStyle` | **string** | The text style name. |

***

### setInlineTextStyles

Set inline text styles.

```php
public setInlineTextStyles(list<array<string,mixed>> $styles): $this
```

**Parameters:**

| Parameter | Type                          | Description        |
|-----------|-------------------------------|--------------------|
| `$styles` | **list<array<string,mixed>>** | The inline styles. |

***

### addInlineTextStyle

Add an inline text style.

```php
public addInlineTextStyle(int $rangeStart, int $rangeLength, string|array<string,mixed> $textStyle): $this
```

**Parameters:**

| Parameter      | Type                            | Description                               |
|----------------|---------------------------------|-------------------------------------------|
| `$rangeStart`  | **int**                         | The starting position.                    |
| `$rangeLength` | **int**                         | The length.                               |
| `$textStyle`   | **string\|array<string,mixed>** | The text style name or inline definition. |

***

### setAdditions

Set additions.

```php
public setAdditions(list<\TomGould\AppleNews\Document\Additions\AdditionInterface> $additions): $this
```

**Parameters:**

| Parameter    | Type                                                               | Description    |
|--------------|--------------------------------------------------------------------|----------------|
| `$additions` | **list<\TomGould\AppleNews\Document\Additions\AdditionInterface>** | The additions. |

***

### addAddition

Add an addition.

```php
public addAddition(\TomGould\AppleNews\Document\Additions\AdditionInterface $addition): $this
```

**Parameters:**

| Parameter   | Type                                                         | Description   |
|-------------|--------------------------------------------------------------|---------------|
| `$addition` | **\TomGould\AppleNews\Document\Additions\AdditionInterface** | The addition. |

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
