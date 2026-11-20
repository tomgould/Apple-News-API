
Chapter container component.

The chapter component organizes article content into chapters,
similar to sections but intended for longer-form content like books
or multi-part articles.

***

* Full name: `\TomGould\AppleNews\Document\Components\Chapter`
* Parent class: [`\TomGould\AppleNews\Document\Components\Container`](./Container.md)

**See Also:**

* https://developer.apple.com/documentation/apple_news/chapter

## Properties

### scene

The scene for this chapter's header area.

```php
protected array<string,mixed>|null $scene
```

***

## Methods

### getRole

Get the role name for the component (e.g., 'body', 'photo', 'heading1').

```php
public getRole(): string
```

***

### setScene

Set the scene for animated header effects using an array.

```php
public setScene(array<string,mixed> $scene): $this
```

**Parameters:**

| Parameter | Type                    | Description              |
|-----------|-------------------------|--------------------------|
| `$scene`  | **array<string,mixed>** | The scene configuration. |

***

### setSceneObject

Set the scene for animated header effects using a typed Scene object.

```php
public setSceneObject(\TomGould\AppleNews\Document\Scenes\SceneInterface $scene): $this
```

This method provides type-safe scene configuration:
```php
$chapter->setSceneObject(FadingStickyHeader::fadeToBlack());
$chapter->setSceneObject(new ParallaxScaleHeader());
```

**Parameters:**

| Parameter | Type                                                   | Description       |
|-----------|--------------------------------------------------------|-------------------|
| `$scene`  | **\TomGould\AppleNews\Document\Scenes\SceneInterface** | The scene object. |

***

### jsonSerialize

Implementation of JsonSerializable.

```php
public jsonSerialize(): array<string,mixed>
```

***

## Inherited methods

### getRole

Get the role name for the component (e.g., 'body', 'photo', 'heading1').

```php
public getRole(): string
```

***

### setIdentifier

Set a unique identifier for this component.

```php
public setIdentifier(string $identifier): static
```

**Parameters:**

| Parameter     | Type       | Description            |
|---------------|------------|------------------------|
| `$identifier` | **string** | The unique identifier. |

***

### setLayout

Set the layout name or inline layout.

```php
public setLayout(string $layout): static
```

**Parameters:**

| Parameter | Type       | Description                              |
|-----------|------------|------------------------------------------|
| `$layout` | **string** | Reference to a name in componentLayouts. |

***

### setStyle

Set the style name.

```php
public setStyle(string $style): static
```

**Parameters:**

| Parameter | Type       | Description                             |
|-----------|------------|-----------------------------------------|
| `$style`  | **string** | Reference to a name in componentStyles. |

***

### getStyle

Get the component style name.

```php
public getStyle(): string|null
```

**Return Value:**

The name set with setStyle(), or null.

***

### setAnchor

Set the anchor configuration.

```php
public setAnchor(string $anchor): static
```

**Parameters:**

| Parameter | Type       | Description               |
|-----------|------------|---------------------------|
| `$anchor` | **string** | The anchor configuration. |

***

### setAnimation

Set component animation using an array.

```php
public setAnimation(array<string,mixed> $animation): static
```

**Parameters:**

| Parameter    | Type                    | Description           |
|--------------|-------------------------|-----------------------|
| `$animation` | **array<string,mixed>** | Animation properties. |

**See Also:**

* https://developer.apple.com/documentation/applenewsformat/fadeinanimation

***

### setAnimationObject

Set the component animation using a typed Animation object.

```php
public setAnimationObject(\TomGould\AppleNews\Document\Animations\AnimationInterface $animation): static
```

This method provides type-safe animation configuration:
```php
$photo->setAnimationObject(FadeInAnimation::fromTransparent());
$body->setAnimationObject(MoveInAnimation::fromLeft());
```

**Parameters:**

| Parameter    | Type                                                           | Description           |
|--------------|----------------------------------------------------------------|-----------------------|
| `$animation` | **\TomGould\AppleNews\Document\Animations\AnimationInterface** | The animation object. |

***

### setBehavior

Set the component behavior using an array.

```php
public setBehavior(array<string,mixed> $behavior): static
```

**Parameters:**

| Parameter   | Type                    | Description                       |
|-------------|-------------------------|-----------------------------------|
| `$behavior` | **array<string,mixed>** | The behavior configuration array. |

**See Also:**

* https://developer.apple.com/documentation/applenewsformat/parallax

***

### setBehaviorObject

Set the component behavior using a typed Behavior object.

```php
public setBehaviorObject(\TomGould\AppleNews\Document\Behaviors\BehaviorInterface $behavior): static
```

This method provides type-safe behavior configuration:
```php
$photo->setBehaviorObject(Parallax::withFactor(0.8));
$photo->setBehaviorObject(new Springy());
```

**Parameters:**

| Parameter   | Type                                                         | Description          |
|-------------|--------------------------------------------------------------|----------------------|
| `$behavior` | **\TomGould\AppleNews\Document\Behaviors\BehaviorInterface** | The behavior object. |

***

### setHidden

Set whether the component is hidden.

```php
public setHidden(bool $hidden): static
```

**Parameters:**

| Parameter | Type     | Description                    |
|-----------|----------|--------------------------------|
| `$hidden` | **bool** | Whether to hide the component. |

***

### setConditional

Set conditional properties for the component.

```php
public setConditional(array<string,mixed> $conditional): static
```

**Parameters:**

| Parameter      | Type                    | Description          |
|----------------|-------------------------|----------------------|
| `$conditional` | **array<string,mixed>** | Array of conditions. |

**See Also:**

* https://developer.apple.com/documentation/applenewsformat/condition

***

### setAdditions

Set the additions for the component.

```php
public setAdditions(array<int,\TomGould\AppleNews\Document\Additions\ComponentLink> $additions): static
```

A ComponentLink makes the whole component tappable:
```php
$photo->setAdditions([ComponentLink::to('https://apple.news/A5vHgPPmQSvuIxPjeXLTdGQ')]);
```

Apple News Format allows `additions` only on some components: Photo,
Image, Figure, Portrait, Logo, ArticleThumbnail, ArticleLink,
ReplicaAdvertisement and the containers (Container, Aside, Chapter,
Header, Section). Those take ComponentLink objects only. Text
components take link ranges instead (see TextComponent::setAdditions()).

A ComponentLink URL must point inside Apple News (an apple.news link, or
the canonicalURL of an article published in News); Apple News ignores
links it cannot resolve.

**Parameters:**

| Parameter    | Type                                                                | Description          |
|--------------|---------------------------------------------------------------------|----------------------|
| `$additions` | **array<int,\TomGould\AppleNews\Document\Additions\ComponentLink>** | The component links. |

**Throws:**

If the component does not support
additions, or an addition is not a ComponentLink.
- [`InvalidArgumentException`](./)

**See Also:**

* https://developer.apple.com/documentation/applenewsformat/componentlink

***

### supportsComponentLink

Whether Apple News Format allows a ComponentLink on this component.

```php
protected supportsComponentLink(): bool
```

***

### getBaseProperties

Get the base properties common to all components for JSON serialization.

```php
protected getBaseProperties(): array<string,mixed>
```

***

### jsonSerialize

Implementation of JsonSerializable.

```php
public jsonSerialize(): array<string,mixed>
```

***

### addComponent

Add a child component to this container.

```php
public addComponent(\TomGould\AppleNews\Document\Components\Component $component): self
```

**Parameters:**

| Parameter    | Type                                                  | Description |
|--------------|-------------------------------------------------------|-------------|
| `$component` | **\TomGould\AppleNews\Document\Components\Component** |             |

***

### getComponents

Get the child components, in the order they were added.

```php
public getComponents(): list<\TomGould\AppleNews\Document\Components\Component>
```

***

### setContentDisplay

Set the content display mode using a string or array.

```php
public setContentDisplay(string|array<string,mixed> $contentDisplay): $this
```

**Parameters:**

| Parameter         | Type                            | Description                        |
|-------------------|---------------------------------|------------------------------------|
| `$contentDisplay` | **string\|array<string,mixed>** | The display mode or configuration. |

***

### setContentDisplayObject

Set the content display mode using a typed ContentDisplay object.

```php
public setContentDisplayObject(\TomGould\AppleNews\Document\Layouts\ContentDisplayInterface $contentDisplay): $this
```

This method provides type-safe content display configuration:
```php
$container->setContentDisplayObject(new HorizontalStackDisplay());
$container->setContentDisplayObject(CollectionDisplay::grid(20, 20));
```

**Parameters:**

| Parameter         | Type                                                             | Description                 |
|-------------------|------------------------------------------------------------------|-----------------------------|
| `$contentDisplay` | **\TomGould\AppleNews\Document\Layouts\ContentDisplayInterface** | The content display object. |

***
