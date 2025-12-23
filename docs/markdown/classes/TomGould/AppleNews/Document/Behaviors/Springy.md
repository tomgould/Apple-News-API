
Springy behavior for device tilt-based movement.

The springy behavior makes a component respond to device tilt with a
spring-like motion, creating a subtle 3D effect as the user moves
their device.

***

* Full name: `\TomGould\AppleNews\Document\Behaviors\Springy`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Behaviors\BehaviorInterface`](./BehaviorInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/springy

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
