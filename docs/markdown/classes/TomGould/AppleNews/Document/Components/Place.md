
Place component for displaying a specific location.

The place component displays a map centered on a specific place
with information about that location.

***

* Full name: `\TomGould\AppleNews\Document\Components\Place`
* Parent class: [`\TomGould\AppleNews\Document\Components\Component`](./Component.md)
* This class is marked as **final** and can't be subclassed
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/place

## Properties

### mapType

The map type.

```php
private ?string $mapType
```

***

### caption

The caption for the place.

```php
private ?string $caption
```

***

### accessibilityCaption

The accessibility caption for VoiceOver users.

```php
private ?string $accessibilityCaption
```

***

### span

Map span configuration.

```php
private array{latitudeDelta?: float, longitudeDelta?: float}|null $span
```

***

### latitude

```php
private float $latitude
```

***

### longitude

```php
private float $longitude
```

***

## Methods

### __construct

Create a new Place component.

```php
public __construct(float $latitude, float $longitude): mixed
```

**Parameters:**

| Parameter    | Type      | Description          |
|--------------|-----------|----------------------|
| `$latitude`  | **float** | The place latitude.  |
| `$longitude` | **float** | The place longitude. |

***

### atCoordinates

Create a Place at specific coordinates.

```php
public static atCoordinates(float $latitude, float $longitude): self
```

* This method is **static**.
**Parameters:**

| Parameter    | Type      | Description          |
|--------------|-----------|----------------------|
| `$latitude`  | **float** | The place latitude.  |
| `$longitude` | **float** | The place longitude. |

**Return Value:**

A new Place instance.

***

### getRole

Get the role name for the component (e.g., 'body', 'photo', 'heading1').

```php
public getRole(): string
```

***

### setMapType

Set the map type.

```php
public setMapType(string $mapType): $this
```

**Parameters:**

| Parameter  | Type       | Description                                       |
|------------|------------|---------------------------------------------------|
| `$mapType` | **string** | The map type ('standard', 'hybrid', 'satellite'). |

***

### setCaption

Set the place caption.

```php
public setCaption(string $caption): $this
```

**Parameters:**

| Parameter  | Type       | Description       |
|------------|------------|-------------------|
| `$caption` | **string** | The caption text. |

***

### setAccessibilityCaption

Set the accessibility caption for VoiceOver.

```php
public setAccessibilityCaption(string $caption): $this
```

**Parameters:**

| Parameter  | Type       | Description                |
|------------|------------|----------------------------|
| `$caption` | **string** | The accessibility caption. |

***

### setSpan

Set the map span (zoom level).

```php
public setSpan(float $latitudeDelta, float $longitudeDelta): $this
```

**Parameters:**

| Parameter         | Type      | Description                    |
|-------------------|-----------|--------------------------------|
| `$latitudeDelta`  | **float** | The latitude span in degrees.  |
| `$longitudeDelta` | **float** | The longitude span in degrees. |

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
