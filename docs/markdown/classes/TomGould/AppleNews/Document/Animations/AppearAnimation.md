
Appear animation for components.

The appear animation causes a component to appear instantly when it
enters the viewport. This is the simplest animation type.

***

* Full name: `\TomGould\AppleNews\Document\Animations\AppearAnimation`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Animations\AnimationInterface`](./AnimationInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/appearanimation

## Properties

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

### setUserControllable

Set whether the animation is user controllable.

```php
public setUserControllable(bool $userControllable): $this
```

When true, the animation progress is tied to scroll position,
allowing users to scrub back and forth through the animation.

**Parameters:**

| Parameter           | Type     | Description                             |
|---------------------|----------|-----------------------------------------|
| `$userControllable` | **bool** | Whether user can control the animation. |

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
