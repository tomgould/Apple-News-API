
Interface for all ANF component behaviors.

Behaviors control how components respond to user interaction,
device motion, and scrolling.

***

* Full name: `\TomGould\AppleNews\Document\Behaviors\BehaviorInterface`
* Parent interfaces:
  `JsonSerializable`

**See Also:**

* https://developer.apple.com/documentation/apple_news/behavior

## Methods

### getType

Get the behavior type identifier.

```php
public getType(): string
```

**Return Value:**

The behavior type (e.g., 'parallax', 'springy').

***
