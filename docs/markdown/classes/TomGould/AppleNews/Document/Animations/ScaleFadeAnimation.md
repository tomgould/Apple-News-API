
Scale-fade animation for components.

The scale_fade animation causes a component to scale up while fading
in when it enters the viewport, creating a zoom-in effect.

***

* Full name: `\TomGould\AppleNews\Document\Animations\ScaleFadeAnimation`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Animations\AnimationInterface`](./AnimationInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/scalefadeanimation

## Properties

### initialAlpha

The initial opacity of the component (0.0 to 1.0).

```php
private ?float $initialAlpha
```

***

### initialScale

The initial scale of the component (e.g., 0.75 for 75% size).

```php
private ?float $initialScale
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

The component will fade from this value to 1.0.

**Parameters:**

| Parameter       | Type      | Description                      |
|-----------------|-----------|----------------------------------|
| `$initialAlpha` | **float** | Initial opacity from 0.0 to 1.0. |

***

### setInitialScale

Set the initial scale value.

```php
public setInitialScale(float $initialScale): $this
```

The component will scale from this value to 1.0.
Values less than 1.0 create a zoom-in effect.

**Parameters:**

| Parameter       | Type      | Description                                |
|-----------------|-----------|--------------------------------------------|
| `$initialScale` | **float** | Initial scale factor (e.g., 0.75 for 75%). |

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

### with

Create a ScaleFadeAnimation with specific values.

```php
public static with(float $initialAlpha, float $initialScale): self
```

* This method is **static**.
**Parameters:**

| Parameter       | Type      | Description                   |
|-----------------|-----------|-------------------------------|
| `$initialAlpha` | **float** | Initial opacity (0.0 to 1.0). |
| `$initialScale` | **float** | Initial scale factor.         |

**Return Value:**

A new ScaleFadeAnimation instance.

***

### subtle

Create a subtle scale-fade animation.

```php
public static subtle(): self
```

Starts at 90%% size and 50%% opacity.

* This method is **static**.
**Return Value:**

A new ScaleFadeAnimation instance.

***

### moderate

Create a moderate scale-fade animation.

```php
public static moderate(): self
```

Starts at 75%% size and 25%% opacity.

* This method is **static**.
**Return Value:**

A new ScaleFadeAnimation instance.

***

### dramatic

Create a dramatic scale-fade animation.

```php
public static dramatic(): self
```

Starts at 50%% size and fully transparent.

* This method is **static**.
**Return Value:**

A new ScaleFadeAnimation instance.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
