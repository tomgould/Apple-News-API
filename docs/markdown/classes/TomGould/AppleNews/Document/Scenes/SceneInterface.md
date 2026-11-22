
Interface for all ANF scene types.

Scenes combine animations and behaviors in the header of a section or chapter.
They create immersive visual effects as users scroll through the article.

***

* Full name: `\TomGould\AppleNews\Document\Scenes\SceneInterface`
* Parent interfaces:
  `JsonSerializable`

**See Also:**

* https://developer.apple.com/documentation/apple_news/scene

## Methods

### getType

Get the scene type identifier.

```php
public getType(): string
```

**Return Value:**

The scene type (e.g., 'fading_sticky_header', 'parallax_scale').

***
