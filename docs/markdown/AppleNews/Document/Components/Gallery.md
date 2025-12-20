
Component for displaying a collection of images as a gallery.

***

* Full name: `\TomGould\AppleNews\Document\Components\Gallery`
* Parent class: [`\TomGould\AppleNews\Document\Components\Component`](./Component)
* This class is marked as **final** and can't be subclassed
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/applenewsformat/gallery

## Properties

### items

```php
private array<string,mixed>[] $items
```

***

## Methods

### getRole

Get the role name for the component (e.g., 'body', 'photo', 'heading1').

```php
public getRole(): string
```

***

### addItem

Add an image to the gallery.

```php
public addItem(string $url, string|null $caption = null, string|null $accessibilityCaption = null): self
```

**Parameters:**

| Parameter               | Type             | Description                    |
|-------------------------|------------------|--------------------------------|
| `$url`                  | **string**       | Image URL (bundle:// or http). |
| `$caption`              | **string\|null** | Optional visible caption.      |
| `$accessibilityCaption` | **string\|null** | Optional VoiceOver caption.    |

***

### jsonSerialize

Implementation of JsonSerializable.

```php
public jsonSerialize(): array<string,mixed>
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
