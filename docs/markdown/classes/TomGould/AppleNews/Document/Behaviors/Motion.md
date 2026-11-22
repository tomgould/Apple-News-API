
Motion behavior for device motion-based parallax.

The motion behavior creates a parallax effect based on device motion,
making components appear to float in 3D space as the user tilts their device.
This is similar to the iOS home screen parallax effect.

***

* Full name: `\TomGould\AppleNews\Document\Behaviors\Motion`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Behaviors\BehaviorInterface`](./BehaviorInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/motion

## Methods

### getType

Get the behavior type identifier.

```php
public getType(): string
```

**Return Value:**

The behavior type (e.g., 'parallax', 'springy').

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array{type: string}
```

***
