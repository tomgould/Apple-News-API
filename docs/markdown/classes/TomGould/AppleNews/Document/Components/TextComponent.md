
Base class for all components that primarily contain text content.

***

* Full name: `\TomGould\AppleNews\Document\Components\TextComponent`
* Parent class: [`\TomGould\AppleNews\Document\Components\Component`](./Component.md)
* This class is an **Abstract class**

**See Also:**

* https://developer.apple.com/documentation/applenewsformat/text

## Properties

### textStyle

```php
protected string|null $textStyle
```

***

### inlineTextStyles

```php
protected array<string,mixed>[]|null $inlineTextStyles
```

***

### format

```php
protected string|null $format
```

***

### text

```php
protected string $text
```

***

## Methods

### __construct

```php
public __construct(string $text): mixed
```

**Parameters:**

| Parameter | Type       | Description           |
|-----------|------------|-----------------------|
| `$text`   | **string** | The raw text content. |

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

| Parameter     | Type       | Description            |
|---------------|------------|------------------------|
| `$identifier` | **string** | The unique identifier. |

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

| Parameter | Type       | Description               |
|-----------|------------|---------------------------|
| `$anchor` | **string** | The anchor configuration. |

***

### setAnimation

Set component animation using an array.

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

### setAnimationObject

Set the component animation using a typed Animation object.

```php
public setAnimationObject(\TomGould\AppleNews\Document\Animations\AnimationInterface $animation): static
```

This method provides type-safe animation configuration:
```php
$photo->setAnimationObject(FadeInAnimation::fromTransparent());
$body->setAnimationObject(MoveInAnimation::fromLeft());
```

**Parameters:**

| Parameter    | Type                                                           | Description           |
|--------------|----------------------------------------------------------------|-----------------------|
| `$animation` | **\TomGould\AppleNews\Document\Animations\AnimationInterface** | The animation object. |

***

### setBehavior

Set the component behavior using an array.

```php
public setBehavior(array<string,mixed> $behavior): static
```

**Parameters:**

| Parameter   | Type                    | Description                       |
|-------------|-------------------------|-----------------------------------|
| `$behavior` | **array<string,mixed>** | The behavior configuration array. |

**See Also:**

* https://developer.apple.com/documentation/applenewsformat/parallax

***

### setBehaviorObject

Set the component behavior using a typed Behavior object.

```php
public setBehaviorObject(\TomGould\AppleNews\Document\Behaviors\BehaviorInterface $behavior): static
```

This method provides type-safe behavior configuration:
```php
$photo->setBehaviorObject(Parallax::withFactor(0.8));
$photo->setBehaviorObject(new Springy());
```

**Parameters:**

| Parameter   | Type                                                         | Description          |
|-------------|--------------------------------------------------------------|----------------------|
| `$behavior` | **\TomGould\AppleNews\Document\Behaviors\BehaviorInterface** | The behavior object. |

***

### setHidden

Set whether the component is hidden.

```php
public setHidden(bool $hidden): static
```

**Parameters:**

| Parameter | Type     | Description                    |
|-----------|----------|--------------------------------|
| `$hidden` | **bool** | Whether to hide the component. |

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
