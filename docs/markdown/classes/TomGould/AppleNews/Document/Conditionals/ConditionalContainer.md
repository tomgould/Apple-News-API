
Conditional properties for container components.

Extends ConditionalComponent with container-specific properties
like contentDisplay.

***

* Full name: `\TomGould\AppleNews\Document\Conditionals\ConditionalContainer`
* Parent class: [`\TomGould\AppleNews\Document\Conditionals\ConditionalComponent`](./ConditionalComponent.md)
* This class is marked as **final** and can't be subclassed
* This class is a **Final class**

**See Also:**

* https://developer.apple.com/documentation/apple_news/conditionalcontainer

## Properties

### contentDisplay

The content display configuration.

```php
private string|array<string,mixed>|null $contentDisplay
```

***

## Methods

### setContentDisplay

Set the content display.

```php
public setContentDisplay(string|array<string,mixed> $contentDisplay): $this
```

**Parameters:**

| Parameter         | Type                            | Description       |
|-------------------|---------------------------------|-------------------|
| `$contentDisplay` | **string\|array<string,mixed>** | The display mode. |

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***

## Inherited methods

### addCondition

Add a condition.

```php
public addCondition(\TomGould\AppleNews\Document\Layouts\Condition $condition): $this
```

**Parameters:**

| Parameter    | Type                                               | Description           |
|--------------|----------------------------------------------------|-----------------------|
| `$condition` | **\TomGould\AppleNews\Document\Layouts\Condition** | The condition to add. |

***

### setConditions

Set multiple conditions.

```php
public setConditions(list<\TomGould\AppleNews\Document\Layouts\Condition> $conditions): $this
```

**Parameters:**

| Parameter     | Type                                                     | Description     |
|---------------|----------------------------------------------------------|-----------------|
| `$conditions` | **list<\TomGould\AppleNews\Document\Layouts\Condition>** | The conditions. |

***

### setHidden

Set whether the component is hidden.

```php
public setHidden(bool $hidden): $this
```

**Parameters:**

| Parameter | Type     | Description     |
|-----------|----------|-----------------|
| `$hidden` | **bool** | Whether hidden. |

***

### setAnchor

Set the anchor.

```php
public setAnchor(string $anchor): $this
```

**Parameters:**

| Parameter | Type       | Description           |
|-----------|------------|-----------------------|
| `$anchor` | **string** | The anchor reference. |

***

### setLayout

Set the layout reference.

```php
public setLayout(string $layout): $this
```

**Parameters:**

| Parameter | Type       | Description      |
|-----------|------------|------------------|
| `$layout` | **string** | The layout name. |

***

### setStyle

Set the style reference.

```php
public setStyle(string $style): $this
```

**Parameters:**

| Parameter | Type       | Description     |
|-----------|------------|-----------------|
| `$style`  | **string** | The style name. |

***

### hiddenOnCompact

Create a conditional that hides on compact width.

```php
public static hiddenOnCompact(): self
```

* This method is **static**.
**Return Value:**

A new instance.

***

### visibleOnRegular

Create a conditional that shows only on regular width.

```php
public static visibleOnRegular(): self
```

* This method is **static**.
**Return Value:**

A new instance.

***

### hasConditions

Check if any conditions have been set.

```php
public hasConditions(): bool
```

**Return Value:**

True if conditions exist.

***

### jsonSerialize

{@inheritdoc}

```php
public jsonSerialize(): array<string,mixed>
```

***
