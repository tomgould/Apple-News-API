
Fade-in animation for components.

The fade_in animation causes a component to fade in from transparent
to fully opaque when it enters the viewport.

***

* Full name: `\TomGould\AppleNews\Document\Animations\FadeInAnimation`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Animations\AnimationInterface`](./AnimationInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/fadeinanimation

## Properties

### initialAlpha

The initial opacity of the component (0.0 to 1.0).

```php
private ?float $initialAlpha
```

***

### userControllable

Whether the animation is controllable by user scroll position.

```php
private ?bool $userControllable
```

***

## Methods

### getType

Get the animation type identifier.

```php
public getType(): string
```

**Return Value:**

The animation type (e.g., 'fade_in', 'move_in').

***

### setInitialAlpha

Set the initial alpha (opacity) value.

```php
public setInitialAlpha(float $initialAlpha): $this
```

The component will fade from this value to 1.0 (fully opaque).

**Parameters:**

| Parameter       | Type      | Description                                             |
|-----------------|-----------|---------------------------------------------------------|
| `$initialAlpha` | **float** | Initial opacity from 0.0 (transparent) to 1.0 (opaque). |

***

### setUserControllable

Set whether the animation is user controllable.

```php
public setUserControllable(bool $userControllable): $this
```

When true, the animation progress is tied to scroll position.

**Parameters:**

| Parameter           | Type     | Description                             |
|---------------------|----------|-----------------------------------------|
| `$userControllable` | **bool** | Whether user can control the animation. |

***

### withInitialAlpha

Create a FadeInAnimation with a specific initial alpha.

```php
public static withInitialAlpha(float $initialAlpha): self
```

* This method is **static**.
**Parameters:**

| Parameter       | Type      | Description                        |
|-----------------|-----------|------------------------------------|
| `$initialAlpha` | **float** | The starting opacity (0.0 to 1.0). |

**Return Value:**

A new FadeInAnimation instance.

***

### fromTransparent

Create a FadeInAnimation starting from fully transparent.

```php
public static fromTransparent(): self
```

* This method is **static**.
**Return Value:**

A new FadeInAnimation with initialAlpha of 0.

***

### subtle

Create a subtle fade-in starting from 50% opacity.

```php
public static subtle(): self
```

* This method is **static**.
**Return Value:**

A new FadeInAnimation with initialAlpha of 0.5.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
