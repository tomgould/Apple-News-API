
Parallax scale header scene.

The parallax_scale scene creates a zoom-out parallax effect on the header
as the user scrolls. The header image scales down while remaining visible,
creating a dramatic reveal effect.

***

* Full name: `\TomGould\AppleNews\Document\Scenes\ParallaxScaleHeader`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\TomGould\AppleNews\Document\Scenes\SceneInterface`](./SceneInterface.md)
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/parallaxscaleheader

## Methods

### getType

Get the scene type identifier.

```php
public getType(): string
```

**Return Value:**

The scene type (e.g., 'fading_sticky_header', 'parallax_scale').

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array{type: string}
```

***
