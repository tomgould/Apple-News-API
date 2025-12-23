
Fading sticky header scene.

The fading_sticky_header scene causes the header to stick to the top of
the screen as the user scrolls, then fade out when the section content
begins to scroll beneath it.

***

* Full name: `\TomGould\AppleNews\Document\Scenes\FadingStickyHeader`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Scenes\SceneInterface`](./SceneInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/fadingstickyheader

## Properties

### fadeColor

The color to fade to (typically matches the section background).

```php
private ?string $fadeColor
```

***

## Methods

### getType

Get the scene type identifier.

```php
public getType(): string
```

**Return Value:**

The scene type (e.g., 'fading_sticky_header', 'parallax_scale').

***

### setFadeColor

Set the fade color.

```php
public setFadeColor(string $color): $this
```

This is the color the header fades to as the user scrolls.
Typically matches the section's background color.

**Parameters:**

| Parameter | Type       | Description                                |
|-----------|------------|--------------------------------------------|
| `$color`  | **string** | The color in hex format (e.g., '#000000'). |

***

### withFadeColor

Create a FadingStickyHeader with a specific fade color.

```php
public static withFadeColor(string $color): self
```

* This method is **static**.
**Parameters:**

| Parameter | Type       | Description                   |
|-----------|------------|-------------------------------|
| `$color`  | **string** | The fade color in hex format. |

**Return Value:**

A new FadingStickyHeader instance.

***

### fadeToBlack

Create a FadingStickyHeader that fades to black.

```php
public static fadeToBlack(): self
```

* This method is **static**.
**Return Value:**

A new FadingStickyHeader instance.

***

### fadeToWhite

Create a FadingStickyHeader that fades to white.

```php
public static fadeToWhite(): self
```

* This method is **static**.
**Return Value:**

A new FadingStickyHeader instance.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
