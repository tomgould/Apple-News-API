
BackgroundParallax behavior for scroll-based background parallax.

The background_parallax behavior applies a parallax effect to the
background of a component as the user scrolls, creating depth.

***

* Full name: `\TomGould\AppleNews\Document\Behaviors\BackgroundParallax`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Behaviors\BehaviorInterface`](./BehaviorInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/backgroundparallax

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
