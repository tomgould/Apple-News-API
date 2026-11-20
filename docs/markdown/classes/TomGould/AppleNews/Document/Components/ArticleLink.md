
Article link component.

The article_link component creates a link to another Apple News article.
It displays a rich preview of the linked article including its thumbnail,
title, and excerpt.

***

* Full name: `\TomGould\AppleNews\Document\Components\ArticleLink`
* Parent class: [`\TomGould\AppleNews\Document\Components\Component`](./Component.md)
* This class is marked as **final** and can't be subclassed
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/articlelink

## Properties

### articleIdentifier

```php
private string $articleIdentifier
```

***

## Methods

### __construct

Create a new ArticleLink component.

```php
public __construct(string $articleIdentifier): mixed
```

**Parameters:**

| Parameter            | Type       | Description                                      |
|----------------------|------------|--------------------------------------------------|
| `$articleIdentifier` | **string** | The unique identifier of the article to link to. |

***

### fromArticleId

Create an ArticleLink from an article ID.

```php
public static fromArticleId(string $articleId): self
```

* This method is **static**.
**Parameters:**

| Parameter    | Type       | Description                |
|--------------|------------|----------------------------|
| `$articleId` | **string** | The Apple News article ID. |

**Return Value:**

A new ArticleLink instance.

***

### getRole

Get the role name for the component (e.g., 'body', 'photo', 'heading1').

```php
public getRole(): string
```

***

### jsonSerialize

Implementation of JsonSerializable.

```php
public jsonSerialize(): array<string,mixed>
```

***

### supportsComponentLink

Whether Apple News Format allows a ComponentLink on this component.

```php
protected supportsComponentLink(): bool
```

***

## Inherited methods

### getRole

Get the role name for the component (e.g., 'body', 'photo', 'heading1').

```php
public getRole(): string
```

* This method is **abstract**.
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

Components that take `additions` override this to return true.

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
