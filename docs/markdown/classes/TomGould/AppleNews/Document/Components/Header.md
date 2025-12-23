
Header container component.

The header component defines the top area of an article, section, or chapter.
It typically contains the title, subtitle, and hero imagery.

***

* Full name: `\TomGould\AppleNews\Document\Components\Header`
* Parent class: [`\TomGould\AppleNews\Document\Components\Container`](./Container.md)

**See Also:**

* https://developer.apple.com/documentation/apple_news/header

## Methods

### getRole

Get the role name for the component (e.g., 'body', 'photo', 'heading1').

```php
public getRole(): string
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
