
Move-in animation for components.

The move_in animation causes a component to slide into view from
a specified direction when it enters the viewport.

***

* Full name: `\TomGould\AppleNews\Document\Animations\MoveInAnimation`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Animations\AnimationInterface`](./AnimationInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/moveinanimation

## Constants

| Constant          | Visibility | Type | Value    |
|-------------------|------------|------|----------|
| `POSITION_LEFT`   | public     |      | 'left'   |
| `POSITION_RIGHT`  | public     |      | 'right'  |
| `POSITION_TOP`    | public     |      | 'top'    |
| `POSITION_BOTTOM` | public     |      | 'bottom' |

## Properties

### preferredStartingPosition

The direction from which the component moves in.

```php
private ?string $preferredStartingPosition
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

### setPreferredStartingPosition

Set the preferred starting position (direction).

```php
public setPreferredStartingPosition(string $position): $this
```

**Parameters:**

| Parameter   | Type       | Description                              |
|-------------|------------|------------------------------------------|
| `$position` | **string** | One of 'left', 'right', 'top', 'bottom'. |

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

### fromLeft

Create a MoveInAnimation from the left.

```php
public static fromLeft(): self
```

* This method is **static**.
**Return Value:**

A new MoveInAnimation instance.

***

### fromRight

Create a MoveInAnimation from the right.

```php
public static fromRight(): self
```

* This method is **static**.
**Return Value:**

A new MoveInAnimation instance.

***

### fromTop

Create a MoveInAnimation from the top.

```php
public static fromTop(): self
```

* This method is **static**.
**Return Value:**

A new MoveInAnimation instance.

***

### fromBottom

Create a MoveInAnimation from the bottom.

```php
public static fromBottom(): self
```

* This method is **static**.
**Return Value:**

A new MoveInAnimation instance.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
