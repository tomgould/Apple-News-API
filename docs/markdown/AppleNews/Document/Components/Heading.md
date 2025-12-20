A heading component (supports levels 1 through 6).

***

* Full name: `\TomGould\AppleNews\Document\Components\Heading`
* Parent class: [`\TomGould\AppleNews\Document\Components\TextComponent`](./TextComponent.md)
* This class is marked as **final** and can't be subclassed
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/applenewsformat/heading

## Properties

### level

```php
private int $level
```

***

## Methods

### __construct

```php
public __construct(string $text, int $level = 1): mixed
```

**Parameters:**

| Parameter | Type       | Description          |
|-----------|------------|----------------------|
| `$text`   | **string** | Heading text.        |
| `$level`  | **int**    | Heading level (1-6). |

***

### getRole

Get the role name for the component (e.g., 'body', 'photo', 'heading1').

```php
public getRole(): string
```

***

## Inherited methods

### getRole

Get the role name for the component (e.g., 'body', 'photo', 'heading1').

```php
public getRole(): string
```

* This method is **abstract**.

***

### setIdentifier

Set a unique identifier for this component.

```php
public setIdentifier(string $identifier): static
```

**Parameters:**

| Parameter     | Type       | Description |
|---------------|------------|-------------|
| `$identifier` | **string** |             |

***

### setLayout

Set the layout name or inline layout.

```php
public setLayout(string $layout): static
```

**Parameters:**

| Parameter | Type       | Description                              |
|-----------|------------|------------------------------------------|
| `$layout` | **string** | Reference to a name in componentLayouts. |

***

### setStyle

Set the style name.

```php
public setStyle(string $style): static
```

**Parameters:**

| Parameter | Type       | Description                             |
|-----------|------------|-----------------------------------------|
| `$style`  | **string** | Reference to a name in componentStyles. |

***

### setAnchor

Set the anchor configuration.

```php
public setAnchor(string $anchor): static
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$anchor` | **string** |             |

***

### setAnimation

Set component animation.

```php
public setAnimation(array<string,mixed> $animation): static
```

**Parameters:**

| Parameter    | Type                    | Description           |
|--------------|-------------------------|-----------------------|
| `$animation` | **array<string,mixed>** | Animation properties. |

**See Also:**

* https://developer.apple.com/documentation/applenewsformat/fadeinanimation

***

### setBehavior

Set component behavior.

```php
public setBehavior(array<string,mixed> $behavior): static
```

**Parameters:**

| Parameter   | Type                    | Description                           |
|-------------|-------------------------|---------------------------------------|
| `$behavior` | **array<string,mixed>** | Behavior properties (e.g., parallax). |

**See Also:**

* https://developer.apple.com/documentation/applenewsformat/parallax

***

### setHidden

Set whether the component is hidden.

```php
public setHidden(bool $hidden): static
```

**Parameters:**

| Parameter | Type     | Description |
|-----------|----------|-------------|
| `$hidden` | **bool** |             |

***

### setConditional

Set conditional properties for the component.

```php
public setConditional(array<string,mixed> $conditional): static
```

**Parameters:**

| Parameter      | Type                    | Description          |
|----------------|-------------------------|----------------------|
| `$conditional` | **array<string,mixed>** | Array of conditions. |

**See Also:**

* https://developer.apple.com/documentation/applenewsformat/condition

***

### getBaseProperties

Get the base properties common to all components for JSON serialization.

```php
protected getBaseProperties(): array<string,mixed>
```

***

### jsonSerialize

Implementation of JsonSerializable.

```php
public jsonSerialize(): array<string,mixed>
```

***

### setTextStyle

Set the text style name.

```php
public setTextStyle(string $textStyle): static
```

**Parameters:**

| Parameter    | Type       | Description |
|--------------|------------|-------------|
| `$textStyle` | **string** |             |

***

### setInlineTextStyles

Define specific styles for ranges of text within this component.

```php
public setInlineTextStyles(array<string,mixed>[] $styles): static
```

**Parameters:**

| Parameter | Type                      | Description |
|-----------|---------------------------|-------------|
| `$styles` | **array<string,mixed>[]** |             |

***

### setFormat

Set the format of the text content ('html' or 'markdown').

```php
public setFormat(string $format): static
```

**Parameters:**

| Parameter | Type       | Description |
|-----------|------------|-------------|
| `$format` | **string** |             |

***

