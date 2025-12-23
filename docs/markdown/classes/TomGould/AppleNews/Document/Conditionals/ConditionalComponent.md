
Conditional properties for any component.

Allows component properties like hidden, anchor, layout, and style
to change based on conditions.

***

* Full name: `\TomGould\AppleNews\Document\Conditionals\ConditionalComponent`
* This class implements:
  [`\TomGould\AppleNews\Document\Conditionals\ConditionalInterface`](./ConditionalInterface.md)

**See Also:**

* https://developer.apple.com/documentation/apple_news/conditionalcomponent

## Properties

### conditions

The conditions that must be met.

```php
protected list<\TomGould\AppleNews\Document\Layouts\Condition> $conditions
```

***

### hidden

Whether the component is hidden.

```php
protected ?bool $hidden
```

***

### anchor

The anchor configuration.

```php
protected ?string $anchor
```

***

### layout

The layout reference.

```php
protected ?string $layout
```

***

### style

The style reference.

```php
protected ?string $style
```

***

## Methods

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
