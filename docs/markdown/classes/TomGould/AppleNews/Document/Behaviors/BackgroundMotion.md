
BackgroundMotion behavior for background motion effects.

The background_motion behavior applies motion effects to the background
of a component, creating depth as the user tilts their device.

***

* Full name: `\TomGould\AppleNews\Document\Behaviors\BackgroundMotion`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Behaviors\BehaviorInterface`](./BehaviorInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/backgroundmotion

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
