
Interface for all ANF component animations.

Animations control how components appear when they come into view
as the user scrolls through the article.

***

* Full name: `\TomGould\AppleNews\Document\Animations\AnimationInterface`
* Parent interfaces:
  `JsonSerializable`

**See Also:**

* https://developer.apple.com/documentation/apple_news/componentanimation

## Methods

### getType

Get the animation type identifier.

```php
public getType(): string
```

**Return Value:**

The animation type (e.g., 'fade_in', 'move_in').

***
